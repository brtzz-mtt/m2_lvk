LVK's essentials for Magento 2
==============================

Base components
---------------

- base theme: ./app/design/frontend/Lkv/base, extending Magento's blank theme, as parent for further children
- backend theme: ./app/design/adminhtml/Lvk/backend, just a minor customization
- base extensions:
    - base: ./app/code/Lkv/Base, extensions commons and backend basic logic
    - design: ./app/code/Lkv/Design, layout customization helper
    - mobile: ./app/code/Lkv/Mobile, additional support for mobile views

Additional stuff
----------------

- children theme: ./app/design/frontend/Lkv/pasta, a frontend child theme prototype

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
│       └── Mobile
│           ├── Block
│           ├── etc
│           │   └── adminhtml
│           ├── i18n
│           ├── Model
│           │   └── Admin
│           │       └── Design
│           │           └── Config
│           │               └── Mobile
│           │                   └── Navigation
│           ├── Observer
│           │   └── Lvk
│           │       └── Design
│           │           └── Admin
│           │               └── System
│           │                   └── Config
│           │                       └── Changed
│           │                           └── Section
│           └── view
│               ├── adminhtml
│               │   ├── layout
│               │   ├── ui_component
│               │   └── web
│               │       └── css
│               └── frontend
│                   ├── layout
│                   ├── templates
│                   │   └── html
│                   └── web
│                       └── js
└── design
    ├── adminhtml
    │   └── Lvk
    │       └── backend
    │           ├── Magento_Theme
    │           │   └── web
    │           └── media
    └── frontend
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
