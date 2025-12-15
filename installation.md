# Irima's Kitchen Theme - Installation & Setup Guide

## Step-by-Step Installation

### 1. Theme Installation

#### Option A: Upload via WordPress Admin
1. Go to WordPress Admin Dashboard
2. Navigate to **Appearance** → **Themes** → **Add New**
3. Click **Upload Theme**
4. Choose the `irimas-kitchen-theme.zip` file
5. Click **Install Now**
6. Click **Activate**

#### Option B: Manual Installation
1. Extract the theme folder
2. Upload to `/wp-content/themes/` via FTP
3. Go to **Appearance** → **Themes**
4. Activate **Irima's Kitchen**

### 2. Initial Configuration

#### Create Required Pages
Navigate to **Pages** → **Add New** and create:

1. **Home** (Set as homepage in Settings → Reading)
2. **Order** 
   - Template: Order Page
3. **Login**
   - Template: Login Page
4. **Register**
   - Template: Register Page
5. **Contact**
   - Template: Contact Page
6. **Menu** (Blog page or custom)
7. **About** (Standard page)

#### Set Homepage
1. Go to **Settings** → **Reading**
2. Select "A static page"
3. Homepage: Select "Home"
4. Posts page: Select "Blog" (if created)

### 3. Menu Configuration

1. Go to **Appearance** → **Menus**
2. Create a new menu named "Primary Navigation"
3. Add pages in this order:
   - Home
   - Menu
   - Order Now (link to /order)
   - About
   - Contact
4. Assign to **Primary Menu** location
5. Create "Footer Menu" and assign to **Footer Menu** location

### 4. Theme Customization

Go to **Appearance** → **Customize**:

#### Hero Section
- Hero Title: "Welcome to Irima's Kitchen"
- Hero Subtitle: "Boutique Restaurant and Catering Services"
- Hero Background Image: Upload a food/restaurant image

#### Contact Information
- Phone Number
- Email Address
- Physical Address (default: Lennox Mall location)

#### Social Media
- Facebook URL
- Instagram URL
- Twitter URL
- YouTube URL (if applicable)

#### Site Identity
- Upload logo (assets/images/logo.png)
- Set site tagline

### 5. Payment Setup (Paystack)

1. Go to **Irima's Dashboard** → **Settings**
2. For **Test Mode**:
   - Check "Enable test mode"
   - Enter Test Public Key
   - Enter Test Secret Key
3. For **Live Mode** (when ready):
   - Uncheck "Enable test mode"
   - Enter Live Public Key
   - Enter Live Secret Key

#### Get Paystack API Keys
1. Sign up at https://paystack.com
2. Go to Settings → API Keys & Webhooks
3. Copy your Public and Secret keys

### 6. Bank Transfer Details

In **Irima's Dashboard** → **Settings**:
- Add your bank account details
- Format example:
```
Bank Name: First Bank Nigeria
Account Name: Irima's Kitchen Ltd
Account Number: 1234567890
```

### 7. Email Notifications

Configure in **Settings**:
- **Order Notification Emails**: Enter comma-separated emails for order alerts
  Example: `orders@irimaskitchen.com, admin@irimaskitchen.com`
- **Contact Form Emails**: Emails for contact form submissions

### 8. Add Menu Items

1. Go to **Menu Items** → **Add New**
2. Add details:
   - Title (e.g., "Jollof Rice with Chicken")
   - Description
   - Featured Image (recommended 600x600px)
   - Price (in NGN)
   - Check "Available" if in stock
   - Add ingredients
   - Set spicy level (if applicable)
3. Assign to **Menu Category**
4. Publish

#### Create Menu Categories
1. Go to **Menu Items** → **Menu Categories**
2. Add categories:
   - Bowls
   - Mains
   - Sides
   - Desserts
   - Drinks

### 9. Test the System

#### Test Order Flow
1. Visit the **Order** page
2. Add items to cart
3. Proceed to checkout
4. Fill in details
5. Test both payment methods:
   - Paystack (use test card: 4084084084084081, CVV: 408, Expiry: 12/26)
   - Bank Transfer

#### Test Contact Form
1. Visit **Contact** page
2. Submit a test message
3. Check if email arrives

#### Test User Registration
1. Visit **Register** page
2. Create a test account
3. Login and check profile

### 10. Build Tailwind CSS (Optional - for developers)

If making CSS changes:

```bash
cd wp-content/themes/irimas-kitchen-theme
npm install
npm run build
```

For development with auto-rebuild:
```bash
npm run dev
```

## Post-Installation

### Security Checklist
- [ ] Change all default passwords
- [ ] Set strong passwords for admin users
- [ ] Enable SSL certificate
- [ ] Configure WordPress security plugins
- [ ] Set up regular backups

### Performance Optimization
- [ ] Install a caching plugin (W3 Total Cache, WP Rocket)
- [ ] Optimize images before uploading
- [ ] Enable CDN if needed
- [ ] Configure lazy loading

### SEO Setup
- [ ] Install Yoast SEO or Rank Math
- [ ] Set up Google Analytics
- [ ] Submit sitemap to Google Search Console
- [ ] Configure meta descriptions

## Common Issues & Solutions

### Issue: Orders not being received
**Solution**: Check email settings in Settings → Email Notifications

### Issue: Payment not working
**Solution**: Verify Paystack API keys and test/live mode setting

### Issue: Cart not updating
**Solution**: Clear browser cache and localStorage

### Issue: Animations not working
**Solution**: Ensure Anime.js is loading (check browser console)

### Issue: Styles not applying
**Solution**: Run `npm run build` to compile Tailwind CSS

## Support

For technical support:
- Email: support@irimaskitchen.com
- Check documentation in README.md

## Maintenance

### Regular Tasks
- Weekly: Review orders and inventory
- Monthly: Update menu items and prices
- Quarterly: Review and update payment settings
- Yearly: Renew SSL and domain

### Backup Schedule
- Daily: Database backup
- Weekly: Full site backup
- Store backups off-site

## Advanced Configuration

### Custom Post Type Endpoints
- Orders: `wp-admin/edit.php?post_type=order`
- Menu Items: `wp-admin/edit.php?post_type=menu_item`
- Contact Submissions: `wp-admin/edit.php?post_type=contact_submission`

### Webhook Setup (for Paystack)
Set webhook URL in Paystack dashboard:
```
https://irimaskitchen.com/wp-admin/admin-ajax.php?action=irimas_paystack_webhook
```

### Custom CSS
Add custom CSS in **Appearance** → **Customize** → **Additional CSS**

## Conclusion

Irima's Kitchen theme is now ready! Test all functionality thoroughly before going live.

For questions or issues, refer to the README.md or contact support.