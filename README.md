# Irima's Kitchen WordPress Theme

A comprehensive, modern WordPress theme for Irima's Kitchen - a boutique restaurant and catering business.

## Features

### Frontend Features
- 🎨 Beautiful, responsive design with Tailwind CSS
- 🎬 Smooth animations with Anime.js
- 🍽️ Menu showcase with categories and filtering
- 🛒 Shopping cart functionality
- 💳 Paystack payment integration
- 🏦 Bank transfer option
- 📱 Mobile-responsive design
- ⚡ Fast and optimized

### Admin Features
- 📊 Custom dashboard with statistics and charts
- 📋 Order management system
- 🍕 Menu item management
- 📧 Email notifications for orders and contacts
- ⚙️ Payment gateway settings (Paystack test/live modes)
- 💬 Contact form submissions tracking

### User Features
- 👤 User registration and login
- 📦 Order history and tracking
- 🔐 Secure authentication
- 📝 Profile management

## Installation

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme in WordPress admin
3. Go to Appearance > Customize to configure theme settings
4. Navigate to Irima's Dashboard > Settings to configure payment options

## Required Pages

Create the following pages and assign templates:

- **Order** → Template: Order Page
- **Login** → Template: Login Page
- **Register** → Template: Register Page  
- **Contact** → Template: Contact Page
- **Profile** → Template: Profile Page (if created)

## Menu Setup

1. Go to Appearance > Menus
2. Create a new menu and assign to "Primary Menu"
3. Add pages: Home, Menu, Order Now, About, Contact

## Payment Configuration

### Paystack Setup
1. Go to Irima's Dashboard > Settings
2. Enter your Paystack API keys (test or live)
3. Toggle test mode as needed

### Bank Transfer Setup
1. Add your bank account details in Settings
2. These details will be shown to customers choosing bank transfer

## Email Notifications

Configure notification emails in Settings:
- Order notifications: Comma-separated emails for order alerts
- Contact form notifications: Emails for contact form submissions

## Color Scheme

- Deep Blue: #1F4E79
- Vibrant Red: #D72638
- Warm Orange: #F49D37
- Fresh Green: #3BB273
- Light Cream: #FDF6EC

## Typography

- Headings: Playfair Display
- Body: Poppins

## Development

### Building Tailwind CSS

```bash
npm install
npm run build
```

### File Structure

```
irimas-kitchen-theme/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── inc/
│   ├── admin-functions.php
│   ├── contact-functions.php
│   ├── custom-post-types.php
│   ├── customizer.php
│   ├── order-functions.php
│   ├── payment-functions.php
│   ├── template-tags.php
│   └── user-functions.php
├── templates/
├── functions.php
├── header.php
├── footer.php
├── index.php
├── page-*.php (templates)
└── style.css
```

## Support

For support and customization, contact the development team.

## Credits

- Built with WordPress, Tailwind CSS, and Anime.js
- Images from Unsplash and Pexels
- Icons from Heroicons

## Version

1.0.0

## License

Proprietary - All rights reserved to Irima's Kitchen