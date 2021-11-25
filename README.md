LVK's essentials for Magento 2
==============================

A collection of some components which can always come to hand

Base components
---------------

- base theme: ./app/design/frontend/Lvk/base, extending Magento's blank theme, as parent for further children
- backend theme: ./app/design/adminhtml/Lvk/backend, just a minor customization
- base extensions:
    - base: ./app/code/Lvk/Base, extensions commons and backend basic logic
    - design: ./app/code/Lvk/Design, layout customization helper
    - mobile: ./app/code/Lvk/Mobile, additional support for mobile views

Additional stuff
----------------

- children theme: ./app/design/frontend/Lvv/pasta, a frontend child theme prototype
- optional extensions:
    - CategoryTree: ./app/code/Lvk/CategoryTree, better category menu for sidebar
    - DeveloperToolBox: ./app/code/Lvk/DeveloperToolBox, catch-all extension
    - GoogleFonts: ./app/code/Lvk/GoogleFonts, small helper for easy implementation
    - Navigation: ./app/code/Lvk/Navigation, some enhancements for desktop and mobile
    - OpeningHours: ./app/code/Lvk/OpeningHours, widget container with own admin
    - SocialLinks: ./app/code/Lvk/SocialLinks, another similar widget container

Directories structure
---------------------

```
app
├── code
│   └── Lvk
│       ├── Base
│       │   ├── etc
│       │   │   └── adminhtml
│       │   ├── Helper
│       │   ├── i18n
│       │   ├── Model
│       │   │   └── Config
│       │   │       └── Source
│       │   ├── Plugin
│       │   │   └── Magento
│       │   │       └── Config
│       │   │           └── Model
│       │   ├── Rewrite
│       │   │   ├── Magento
│       │   │   │   └── Framework
│       │   │   │       ├── Logger
│       │   │   │       │   └── Handler
│       │   │   │       └── Module
│       │   │   │           └── Plugin
│       │   │   └── Monolog
│       │   ├── Test
│       │   │   └── Unit
│       │   │       ├── Helper
│       │   │       ├── Model
│       │   │       │   └── Config
│       │   │       │       └── Source
│       │   │       ├── Plugin
│       │   │       │   └── Magento
│       │   │       │       └── Config
│       │   │       │           └── Model
│       │   │       └── Rewrite
│       │   │           └── Magento
│       │   │               └── Framework
│       │   │                   ├── Logger
│       │   │                   │   └── Handler
│       │   │                   └── Module
│       │   │                       └── Plugin
│       │   └── view
│       │       └── adminhtml
│       │           ├── layout
│       │           ├── templates
│       │           └── web
│       │               ├── css
│       │               └── images
│       ├── CategoryTree
│       │   ├── Block
│       │   │   └── Frontend
│       │   ├── etc
│       │   │   └── adminhtml
│       │   ├── Helper
│       │   ├── i18n
│       │   ├── Model
│       │   │   └── Config
│       │   │       └── Source
│       │   └── view
│       │       └── adminhtml
│       │           ├── layout
│       │           └── web
│       │               └── css
│       ├── Design
│       │   ├── Block
│       │   │   ├── Catalog
│       │   │   │   └── Product
│       │   │   │       └── ProductList
│       │   │   └── Sidebar
│       │   ├── Controller
│       │   │   ├── Responsivity
│       │   │   └── Styleguide
│       │   ├── etc
│       │   │   ├── adminhtml
│       │   │   └── frontend
│       │   ├── Helper
│       │   ├── i18n
│       │   ├── Model
│       │   │   ├── Catalog
│       │   │   ├── Config
│       │   │   │   └── Body
│       │   │   │       └── Background
│       │   │   └── Design
│       │   │       └── Backend
│       │   │           └── Body
│       │   ├── Observer
│       │   │   ├── Admin
│       │   │   │   └── System
│       │   │   │       └── Config
│       │   │   │           └── Changed
│       │   │   │               └── Section
│       │   │   └── Lvk
│       │   │       └── DeveloperToolBox
│       │   │           └── Block
│       │   └── view
│       │       ├── adminhtml
│       │       │   ├── layout
│       │       │   ├── ui_component
│       │       │   └── web
│       │       │       ├── css
│       │       │       ├── images
│       │       │       ├── js
│       │       │       │   └── form
│       │       │       │       └── element
│       │       │       └── template
│       │       │           └── form
│       │       │               └── element
│       │       └── frontend
│       │           ├── layout
│       │           ├── page_layout
│       │           ├── templates
│       │           │   ├── catalog
│       │           │   │   └── product
│       │           │   │       └── productlist
│       │           │   │           └── toolbar
│       │           │   └── sidebar
│       │           └── web
│       │               ├── css
│       │               └── js
│       ├── DeveloperToolBox
│       │   ├── Block
│       │   ├── Controller
│       │   │   └── Adminhtml
│       │   │       └── Component
│       │   ├── etc
│       │   │   └── adminhtml
│       │   ├── Helper
│       │   ├── i18n
│       │   ├── Model
│       │   │   └── Config
│       │   │       └── Source
│       │   ├── Observer
│       │   │   └── Backend
│       │   │       └── Auth
│       │   │           └── User
│       │   │               └── Login
│       │   ├── Scaffold
│       │   │   ├── Block
│       │   │   │   └── Adminhtml
│       │   │   ├── Controller
│       │   │   │   └── Adminhtml
│       │   │   ├── documentation
│       │   │   │   ├── de_DE
│       │   │   │   ├── en_EN
│       │   │   │   └── it_IT
│       │   │   ├── etc
│       │   │   │   ├── adminhtml
│       │   │   │   └── frontend
│       │   │   ├── Helper
│       │   │   ├── i18n
│       │   │   ├── Model
│       │   │   ├── Observer
│       │   │   ├── Setup
│       │   │   ├── Test
│       │   │   │   └── Unit
│       │   │   └── view
│       │   │       ├── adminhtml
│       │   │       │   ├── layout
│       │   │       │   ├── templates
│       │   │       │   ├── ui_component
│       │   │       │   └── web
│       │   │       │       ├── css
│       │   │       │       ├── fonts
│       │   │       │       ├── images
│       │   │       │       │   └── documentation
│       │   │       │       ├── js
│       │   │       │       └── template
│       │   │       └── frontend
│       │   │           ├── layout
│       │   │           ├── page_layout
│       │   │           ├── templates
│       │   │           └── web
│       │   │               ├── css
│       │   │               ├── fonts
│       │   │               ├── images
│       │   │               └── js
│       │   └── view
│       │       ├── adminhtml
│       │       │   ├── layout
│       │       │   └── web
│       │       │       ├── css
│       │       │       └── images
│       │       └── frontend
│       │           ├── layout
│       │           ├── templates
│       │           └── web
│       │               ├── css
│       │               └── images
│       ├── GoogleFonts
│       │   ├── Block
│       │   │   └── Adminhtml
│       │   │       └── System
│       │   │           └── Config
│       │   ├── Controller
│       │   │   └── Font
│       │   ├── etc
│       │   │   ├── adminhtml
│       │   │   └── frontend
│       │   ├── Helper
│       │   ├── i18n
│       │   ├── Model
│       │   │   ├── Admin
│       │   │   │   └── Design
│       │   │   │       └── Config
│       │   │   │           └── Font
│       │   │   └── Config
│       │   │       └── Source
│       │   ├── Observer
│       │   │   └── Lvk
│       │   │       └── Design
│       │   │           └── Admin
│       │   │               └── System
│       │   │                   └── Config
│       │   │                       └── Changed
│       │   │                           └── Section
│       │   └── view
│       │       ├── adminhtml
│       │       │   ├── layout
│       │       │   ├── templates
│       │       │   │   └── system
│       │       │   │       └── config
│       │       │   ├── ui_component
│       │       │   └── web
│       │       │       ├── css
│       │       │       ├── js
│       │       │       └── template
│       │       │           └── form
│       │       │               └── element
│       │       └── frontend
│       │           └── layout
│       ├── Mobile
│       │   ├── Block
│       │   ├── etc
│       │   │   └── adminhtml
│       │   ├── i18n
│       │   ├── Model
│       │   │   └── Admin
│       │   │       └── Design
│       │   │           └── Config
│       │   │               └── Mobile
│       │   │                   └── Navigation
│       │   ├── Observer
│       │   │   └── Lvk
│       │   │       └── Design
│       │   │           └── Admin
│       │   │               └── System
│       │   │                   └── Config
│       │   │                       └── Changed
│       │   │                           └── Section
│       │   └── view
│       │       ├── adminhtml
│       │       │   ├── layout
│       │       │   ├── ui_component
│       │       │   └── web
│       │       │       └── css
│       │       └── frontend
│       │           ├── layout
│       │           ├── templates
│       │           │   └── html
│       │           └── web
│       │               └── js
│       ├── Navigation
│       │   ├── Block
│       │   │   └── Adminhtml
│       │   │       └── Form
│       │   │           └── Field
│       │   ├── etc
│       │   │   ├── adminhtml
│       │   │   └── frontend
│       │   ├── Helper
│       │   ├── i18n
│       │   └── view
│       │       ├── adminhtml
│       │       │   ├── layout
│       │       │   └── web
│       │       │       └── css
│       │       └── frontend
│       │           ├── layout
│       │           └── templates
│       │               └── default
│       ├── OpeningHours
│       │   ├── Block
│       │   │   ├── Adminhtml
│       │   │   │   └── System
│       │   │   │       └── Config
│       │   │   ├── Opening
│       │   │   └── Status
│       │   ├── etc
│       │   │   └── adminhtml
│       │   ├── Helper
│       │   ├── i18n
│       │   ├── Model
│       │   │   └── Config
│       │   │       └── Source
│       │   │           └── Days
│       │   └── view
│       │       ├── adminhtml
│       │       │   ├── layout
│       │       │   ├── templates
│       │       │   │   └── system
│       │       │   │       └── config
│       │       │   │           └── opening
│       │       │   └── web
│       │       │       ├── css
│       │       │       └── images
│       │       │           └── doc
│       │       └── frontend
│       │           └── templates
│       └── SocialLinks
│           ├── Block
│           │   └── Frontend
│           ├── etc
│           │   └── adminhtml
│           ├── Helper
│           ├── i18n
│           ├── Model
│           │   └── Config
│           │       └── Source
│           └── view
│               ├── adminhtml
│               │   ├── layout
│               │   └── web
│               │       ├── css
│               │       └── fonts
│               └── frontend
│                   ├── layout
│                   ├── templates
│                   └── web
│                       ├── css
│                       └── fonts
└── design
    ├── adminhtml
    │   └── Lvk
    │       └── backend
    │           ├── Magento_Theme
    │           │   └── web
    │           └── media
    └── frontend
        └── Lvk
            ├── base
            │   ├── Magento_Catalog
            │   │   ├── layout
            │   │   └── web
            │   │       └── css
            │   │           └── source
            │   │               └── module
            │   ├── Magento_Checkout
            │   │   └── web
            │   │       ├── js
            │   │       └── template
            │   │           └── minicart
            │   ├── Magento_Review
            │   │   └── web
            │   │       └── css
            │   │           └── source
            │   ├── Magento_Theme
            │   │   ├── layout
            │   │   └── web
            │   ├── Magento_Wishlist
            │   │   └── web
            │   │       └── css
            │   │           └── source
            │   └── web
            │       ├── css
            │       │   └── source
            │       │       └── _responsivity
            │       │           ├── _desktop
            │       │           └── _mobile
            │       └── images
            └── pasta
                ├── Magento_Theme
                │   ├── layout
                │   └── web
                ├── media
                └── web
                    ├── css
                    │   └── source
                    └── images
```

---

Copyright © 2021 Bertozzi Matteo
