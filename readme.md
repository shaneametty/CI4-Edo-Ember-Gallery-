<div align="center">

<img src="https://i.pinimg.com/originals/8c/42/43/8c4243960da81dba835adc6bbbcfda27.gif" alt="Litten Group" width="130" height="100">

<h1>Edo Ember Gallery</h1>

<p><strong>Bringing classic brushwork to the digital age.</strong></p>

<p>A web-based art and design studio platform that showcases both traditional and modern artworks, multimedia installations, and creative collaborations.<br>
This project demonstrates CRUD-based gallery and commission management, built for artists, clients, and curators.</p>

</div>

**Group:** Litten  

**Team Leader:** Tampipig, Shane

**Members:**  
- Bundalian, Romeo Andree  
- Gonzales, Orven  
- Japon, Althaea  
- Sapallo, Cyrus  

---

## Table of Contents
- [Overview](#overview)
- [Project Features](#project-features)
- [Key Components](#key-components)
- [Products & Services](#products--services)
- [Technology](#technology)
- [About](#about)

---

## Overview  
**Edo Ember Gallery** is an art and design studio that bridges tradition and innovation—a creative hub where classic artistry meets modern digital expression.  
The platform showcases **traditional and modern artworks, installations, and multimedia pieces**, and provides artists and clients with a space to collaborate, commission, and share their work.

**Purpose:**  
To provide a collaborative, interactive digital space where artists can showcase, sell, and commission artworks while maintaining creative authenticity.  

**Audience:**  
Artists, collectors, and art enthusiasts looking to explore and support modern and traditional art in one cohesive online environment.

---

## Project Features
| Feature | Description |
|---------|-------------|
| **User Management (Admin)** | Admins can create, update, and manage user profiles, including artists and clients. |
| **Product Management** | Admins can manage artworks, prints, merchandise, and other gallery products. |
| **Order Management** | Customers can place and track orders; admins can manage and update order statuses. |

---

## Key Components
| Component | Purpose | Notes |
|-----------|---------|-------|
| Profile Management | Handles admin, artist, and client registration, profile creation, and updates. | Demonstrates CRUD operations and relational linking. |
| Artworks & Exhibits | Displays featured artworks, collections, and multimedia exhibits. | Integrates image uploads, metadata, and curation. |
| Products & Services | Lists purchasable art prints, merchandise, and service offerings. | Demonstrates e-commerce-style CRUD logic. |
| Admin Dashboard | Enables admins to manage users, artworks, and orders. | Controls backend data and system configurations. |

---

## Products & Services  

### **Services**  
- 🖼️ **Custom Artwork Commissions** – Request personalized art pieces made by professional artists.  
- 🌐 **Virtual Gallery Events** – Experience curated art exhibits and events in an immersive online space.  
- 🤝 **Artist Collaboration Packages** – Connect with other creatives and collaborate on special projects.  

### **Products**  
- 📚 **Art Prints & Books** – High-quality prints and art publications.  
- 🖌️ **Original Artworks** – One-of-a-kind pieces from talented artists.  
- 🎁 **Art-Inspired Merchandise** – Collectibles, clothing, and accessories inspired by featured works.  

---

### Technology

#### Language

![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge\&logo=html5\&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge\&logo=css3\&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge\&logo=javascript\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge\&logo=php\&logoColor=white)

#### Framework/Library

![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?style=for-the-badge\&logo=tailwindcss\&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-EF4223?style=for-the-badge\&logo=codeigniter\&logoColor=white)

---

## Quick Start (Docker)

Run the development stack and the app (rebuild if needed):

```cmd
docker compose up --watch
```

Common utility commands (run inside the project root):

- Run migrations:
```cmd
docker compose exec php composer migrate
```
- Run seeders:
```cmd
docker compose exec php composer seed
```
- Run tests:
```cmd
docker compose exec php composer test
```

- Create a migration (using CodeIgniter's spark tool):
```cmd
docker compose exec php php spark make:migration CreateUsersTabel
```

- Create a model (using CodeIgniter's spark tool):

```cmd
docker compose exec php php spark make:model UsemModel
```

- Create an entity (value object for a single record) (using CodeIgniter's spark tool):
```cmd
docker compose exec php php spark make:entity Uzer
```

- Create a controller (add --resource to scaffold resourceful methods if you like) (using CodeIgniter's spark tool):
```cmd
docker compose exec php php spark make:controller Usars
```

- Create a seeder (for test/dev data) (using CodeIgniter's spark tool):
```cmd
docker compose exec php php spark make:seeder UserzSeeder
```

If you prefer, you can include `-f "compose.yaml"` explicitly; the shorter commands above work when running from the repo root.

## Ports & Database

Defaults used in this project (host mapping):

| Service     | Host port |
|-------------|-----------:|
| nginx (app) | 8090      |
| phpMyAdmin  | 8091      |
| MySQL       | 3390      |

Database credentials used in examples and CI:

- Host: localhost
- Port: 3390
- Database: app
- User: root
- Password: root

Be careful: seeding and truncating are destructive operations — run only on local/dev environments unless you know what you're doing.

## Rules, Practices and Principles

<!-- ! Dont Revise this -->

1. Always prefix project titles with `AD-`.
2. Place files in their **respective CI4 folders** (`Controllers/`, `Services/`, `Repositories/`, `Views/`).
3. Naming conventions:

   | Type             | Case        | Example                   |
   | ---------------- | ----------- | ------------------------- |
   | Classes          | PascalCase  | `UserService.php`         |
   | Interfaces       | PascalCase  | `UserRepositoryInterface` |
   | DB tables/fields | snake\_case | `users`, `created_at`     |
   | Docs             | kebab-case  | `dev-manual.md`           |

4. Git commits use: `feat`, `fix`, `docs`, `refactor`.
5. Use **Controller → Service → Repository** pattern.
6. Assets (CSS/JS/img) live under `public/`.
7. Docker configs are at the repo root (`docker-compose.yml`, `nginx.conf`).
8. Docs are maintained in `/docs` (dev, technical, sop, commit, principles, copilot).

Example structure:

```
AD-ProjectName/
├─ backend/ci4/
│  ├─ app/Controllers/
│  ├─ app/Services/
│  ├─ app/Repositories/
│  ├─ app/Views/
│  ├─ public/
│  ├─ writable/
│  ├─ .env
│  └─ composer.json
├─ docker/               # Docker configs at root
├─ docs/                 # Manuals and project docs
├─ .gitignore
└─ readme.md
```

<!-- ! Dont Revise this -->

---

## Resources

| Title                   | Purpose                                                               | Link                                                                       |
| ----------------------- | --------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| ChatGPT                 | General AI assistance for planning application architecture and docs. | [https://chat.openai.com](https://chat.openai.com)                         |
| GitHub Copilot          | In-IDE code suggestions and boilerplate generation.                   | [https://github.com/features/copilot](https://github.com/features/copilot) |
| YouTube “UI/UX Design”  | Video tutorials on modern web interface layouts and patterns.         | [https://www.youtube.com](https://www.youtube.com)                         |
| Pinterest Design Boards | Inspiration for color schemes, typography, and component layouts.     | [https://www.pinterest.com](https://www.pinterest.com)                     |
| Google Photos (Assets)  | Stock imagery and graphics used in UI mockups and documentation.      | [https://photos.google.com](https://photos.google.com)                     |
| System Documentation    | Internal docs from PHP, MongoDB, and PostgreSQL used in development.  | — (see `/docs` folder in repo)                                             |


---

**© 2025 Edo Ember Gallery – All Rights Reserved**
