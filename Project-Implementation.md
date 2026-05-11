---

# 🧩 PROJECT OVERVIEW

Build a **minimalist writing portal (blog platform)** with focus on:

* clean reading experience
* fast navigation
* modern UI/UX

NO admin panel generator (like Filament). Everything must be **custom built**.

---

# ⚙️ TECH STACK

## Backend

* Laravel (latest version)
* MySQL
* Eloquent ORM
* MVC pattern

## Frontend

* Blade templating
* Tailwind CSS (utility-first)
* Reusable Blade components
* Alpine.js (for interactivity)

## UI Libraries

* SweetAlert (for notifications)
* Google Material Icons

---

# 🧱 DATABASE STRUCTURE

Create migrations based on this schema:

### users

* id
* name
* username (unique)
* email (unique)
* password
* avatar (nullable)
* bio (nullable)
* role (admin, author, user)
* status (active, inactive)
* timestamps

### categories

* id
* name
* slug (unique)
* timestamps

### tags

* id
* name
* slug (unique)
* timestamps

### posts

* id
* user_id (FK)
* category_id (FK)
* title
* slug (unique)
* excerpt
* content (long text)
* cover_image
* reading_time
* status (draft, published)
* published_at
* timestamps

### post_tags

* id
* post_id
* tag_id

### post_views

* id
* post_id
* ip_address
* user_agent
* created_at

### bookmarks

* id
* post_id
* user_id (nullable)
* user_identifier (nullable)
* created_at

---

# 🔗 RELATIONSHIPS

* User hasMany Posts
* Post belongsTo User
* Post belongsTo Category
* Post belongsToMany Tags
* Post hasMany Views
* Post hasMany Bookmarks

---

# 🧠 CORE FEATURES

## 1. Public Pages

* Homepage (latest + popular posts)
* Post list page
* Post detail page
* Category page
* Tag page
* Search page

---

## 2. Admin (Custom, no Filament)

* Login (only admin)
* CRUD Posts
* CRUD Categories
* CRUD Tags
* Upload cover image

---

## 3. Post Features

* Auto generate slug
* Auto calculate reading time (200 words = 1 min)
* Draft & Publish system
* Related posts (by category or tag)

---

# 🎨 UI/UX REQUIREMENTS

## Design Style

* minimalist
* clean typography
* lots of whitespace
* responsive (mobile-first)

---

## COMPONENTS (REQUIRED)

Create reusable Blade components:

* <x-navbar>
* <x-post-card> (for gallery)
* <x-post-list-item> (for list view)
* <x-toggle-button>
* <x-badge>
* <x-container>

---

# 🔥 INTERACTIVE FEATURES

## 1. 🌙 Dark / Light Mode Toggle

* Toggle button in navbar
* Save preference in localStorage
* Apply Tailwind dark mode
* Smooth transition

---

## 2. 📖 Reading Mode Toggle

On post detail page:

* hide sidebar/navbar
* increase font size
* reduce max width
* focus on content only

---

## 3. 🧩 Gallery / List View Toggle

On post listing page:

### Gallery View (default)

* grid layout (cards)
* image + title

### List View

* horizontal layout
* small thumbnail
* title + excerpt + meta

Save mode in localStorage

---

## 4. 📊 Reading Progress Bar

* fixed at top
* indicates scroll progress

---

## 5. 🔍 Search

* search posts by title & content
* simple implementation (LIKE query)
* debounce input (Alpine.js)

---

## 6. 🔖 Bookmark (No Login)

* store in localStorage
* optional sync to DB
* toggle bookmark button

---

## 7. 👁️ Post Views Counter

* increment on visit
* avoid duplicate using session or IP

---

## 8. 🔄 Related Posts

* show 3–5 related posts
* based on category or tags

---

# 📱 MOBILE BEHAVIOR

* default list view on mobile
* grid max 2 columns
* toggle buttons accessible
* readable typography

---

# ⚡ PERFORMANCE

* lazy load images
* optimize queries (eager loading)
* pagination for posts

---

# 🔐 AUTH (ADMIN ONLY)

* Laravel Breeze or simple custom auth
* restrict admin routes
* middleware: auth + role check

---

# 📁 CODE STRUCTURE

* clean controller separation:

  * PostController (public)
  * Admin/PostController
* service class for:

  * reading time
  * slug generation

---

# 🎯 OUTPUT EXPECTATION

Generate:

1. migrations
2. models + relationships
3. controllers (public + admin)
4. routes (web.php)
5. Blade views (layout + pages)
6. Tailwind UI components
7. Alpine.js scripts for toggles
8. helper/service classes

Code must be:

* clean
* modular
* reusable
* easy to scale

---

# 🚀 IMPORTANT

* Do NOT overcomplicate
* Focus on clean UX
* Use best Laravel practices
* Make it production-ready

---