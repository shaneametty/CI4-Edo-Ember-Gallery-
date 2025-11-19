<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\ProductsModel;
use App\Models\OrdersModel;
use App\Models\OrderItemsModel;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Admin Controller
 * 
 * Handles all admin-related functionality including:
 * - Dashboard overview with statistics
 * - System analytics
 * - Quick access to management functions
 */
class Admin extends BaseController
{
    protected $usersModel;
    protected $productsModel;
    protected $ordersModel;
    protected $orderItemsModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->productsModel = new ProductsModel();
        $this->ordersModel = new OrdersModel();
        $this->orderItemsModel = new OrderItemsModel();
    }

    /**
     * Dashboard Overview
     * 
     * Displays key metrics and statistics for the admin
     * - Total users, products, orders
     * - Revenue statistics
     * - Low stock alerts
     * - Recent orders
     * - Status breakdowns
     */
    public function dashboard()
    {
        // Get statistics
        $stats = [
            'total_users' => $this->getTotalUsers(),
            'total_products' => $this->getTotalProducts(),
            'total_revenue' => $this->getTotalRevenue(),
            'total_orders' => $this->getTotalOrders(),
            'pending_orders' => $this->getPendingOrders(),
            'low_stock_count' => $this->getLowStockCount(),
        ];

        // Get low stock products (stock <= 5)
        $lowStockProducts = $this->productsModel
            ->where('stock <=', 5)
            ->where('is_available', 1)
            ->orderBy('stock', 'ASC')
            ->findAll(10); // Limit to 10 items

        // Get recent orders (last 10)
        $recentOrders = $this->ordersModel
            ->orderBy('created_at', 'DESC')
            ->findAll(10);

        // Get order status breakdown
        $orderStatusBreakdown = $this->getOrderStatusBreakdown();

        // Get revenue by month (last 6 months)
        $revenueByMonth = $this->getRevenueByMonth(6);

        // Get top selling products
        $topProducts = $this->getTopSellingProducts(5);

        // Prepare data for view
        $data = [
            'title' => '🔥 Admin Dashboard',
            'stats' => $stats,
            'lowStockProducts' => $lowStockProducts,
            'recentOrders' => $recentOrders,
            'orderStatusBreakdown' => $orderStatusBreakdown,
            'revenueByMonth' => $revenueByMonth,
            'topProducts' => $topProducts,
        ];

        return view('admin/dashboard', $data);
    }

    // ============================================
    // HELPER METHODS FOR STATISTICS
    // ============================================

    /**
     * Get total number of active users
     */
    private function getTotalUsers(): int
    {
        return $this->usersModel->where('is_active', 1)->countAllResults();
    }

    /**
     * Get total number of available products
     */
    private function getTotalProducts(): int
    {
        return $this->productsModel->countAllResults();
    }

    /**
     * Get total revenue from all paid orders
     */
    private function getTotalRevenue(): float
    {
        $result = $this->ordersModel
            ->selectSum('total_amount')
            ->where('payment_status', 'paid')
            ->get()
            ->getRow();

        return $result->total_amount ?? 0.00;
    }

    /**
     * Get total number of orders
     */
    private function getTotalOrders(): int
    {
        return $this->ordersModel->countAllResults();
    }

    /**
     * Get number of pending orders
     */
    private function getPendingOrders(): int
    {
        return $this->ordersModel->where('status', 'pending')->countAllResults();
    }

    /**
     * Get count of low stock products (stock <= 5)
     */
    private function getLowStockCount(): int
    {
        return $this->productsModel
            ->where('stock <=', 5)
            ->where('is_available', 1)
            ->countAllResults();
    }

    /**
     * Get order status breakdown
     * Returns count for each status
     */
    private function getOrderStatusBreakdown(): array
    {
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $breakdown = [];

        foreach ($statuses as $status) {
            $count = $this->ordersModel->where('status', $status)->countAllResults();
            $breakdown[$status] = $count;
        }

        return $breakdown;
    }

    /**
     * Get revenue by month
     * 
     * @param int $months Number of months to retrieve
     * @return array Array of revenue by month
     */
    private function getRevenueByMonth(int $months = 6): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('orders');

        $result = $builder
            ->select("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_amount) as revenue")
            ->where('payment_status', 'paid')
            ->where('created_at >=', date('Y-m-d', strtotime("-$months months")))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get()
            ->getResultArray();

        return $result;
    }

    /**
     * Get top selling products
     * 
     * FIXED: Now complies with MySQL's ONLY_FULL_GROUP_BY mode
     * Uses ANY_VALUE() to get product_name since all product_names 
     * for the same product_id should be identical.
     * 
     * @param int $limit Number of products to retrieve
     * @return array Top selling products
     */
    private function getTopSellingProducts(int $limit = 5): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('order_items');

        $result = $builder
            ->select('order_items.product_id, ANY_VALUE(order_items.product_name) as product_name, SUM(order_items.quantity) as total_sold, SUM(order_items.subtotal) as total_revenue')
            ->groupBy('order_items.product_id')
            ->orderBy('total_sold', 'DESC')
            ->limit($limit)
            ->get()
            ->getResultArray();

        return $result;
    }
}