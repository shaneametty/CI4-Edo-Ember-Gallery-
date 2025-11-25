<?php
// Component: components/head.php
// Data contract:
// $title: string
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc(isset($title) ? $title . " " : " ") ?></title>

    <!-- Google Fonts: Cormorant Garamond + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        :root {
            --primary: #ad0013;
            --secondary: #a67d43;
            --accent: #121312;
            --neutral: #e5e2dc;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background-color: var(--accent);
            color: var(--neutral);
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            color: var(--neutral);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--secondary);
        }

        .btn-border {
            border: 2px solid var(--secondary);
            color: var(--secondary);
            transition: all 0.3s;
            font-weight: 600;
        }

        .btn-border:hover {
            background: var(--secondary);
            color: var(--accent);
        }

        ::-webkit-scrollbar {
            width: 12px;
            height: 12px;
        }

        ::-webkit-scrollbar-track {
            background: var(--neutral);
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 8px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--secondary) 0%, var(--primary) 100%);
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: var(--primary) var(--neutral);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .reveal-on-scroll.appear {
            opacity: 1;
            transform: translateY(0);
        }

        .parallax {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
    </style>
</head>