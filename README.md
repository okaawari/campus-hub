# 🎓 Campus Hub

**A comprehensive student platform for academic success, community engagement, and resource sharing.**

Campus Hub is a modern web application built with Laravel that empowers students to share study materials, find tutors, trade textbooks, participate in discussions, and connect with their campus community.

![Campus Hub](https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=for-the-badge&logo=php)
![Livewire](https://img.shields.io/badge/Livewire-3.x-purple?style=for-the-badge&logo=livewire)
![Flux UI](https://img.shields.io/badge/Flux%20UI-Latest-green?style=for-the-badge)

## ✨ Features

### 📚 **Study Materials Hub**
- Upload and share study materials (notes, exams, flashcards)
- Smart categorization by subject and course
- Download tracking and rating system
- File type support for PDFs, documents, and images

### 👨‍🏫 **Peer Tutoring Network**
- Create tutor profiles with qualifications and rates
- Schedule tutoring sessions with integrated booking
- Rating and review system for tutors
- Subject-based tutor discovery

### 📖 **Textbook Marketplace**
- List textbooks for sale, rent, or exchange
- Condition tracking and price comparison
- Course-based textbook matching
- Secure contact system for transactions

### 🎯 **Campus Events**
- Create and discover campus events
- RSVP system with attendance tracking
- Event categories and filtering
- Calendar integration

### 💬 **Discussion Forums**
- Academic discussions and Q&A
- Subject-specific forum categories
- Voting system for helpful answers
- Community moderation features

### 📱 **Personal Library**
- **My Documents**: Manage your uploaded materials
- **Saved Materials**: Bookmark useful resources
- **Bookmarks**: Save interesting events and discussions
- **Recent Activity**: Track your contributions

### 🌟 **Community Discovery**
- **Top Uploads**: Most downloaded materials
- **Most Liked**: Highest rated content
- **Top Rated**: Quality content across categories
- **Trending**: Hot recent activity

### ⚙️ **Enhanced User Profiles**
- Comprehensive academic information
- University, major, and graduation year
- Academic interests and social links
- Contact preferences and privacy settings

## 🚀 Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (default) or MySQL/PostgreSQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/campus-hub.git
   cd campus-hub
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   php artisan db:seed --class=CampusHubSeeder
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see Campus Hub in action!

## 🏗️ Technology Stack

### Backend
- **Laravel 11.x** - Robust PHP framework with elegant syntax
- **Livewire 3.x** - Dynamic frontend interactions without JavaScript complexity
- **SQLite/MySQL** - Reliable database with ACID compliance
- **Laravel Breeze** - Authentication scaffolding
- **WorkOS** - Enterprise-grade authentication

### Frontend
- **Flux UI** - Modern component library built on Tailwind CSS
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework (via Livewire)
- **Vite** - Fast build tool and development server

### Features & Integrations
- **File Storage** - Laravel's filesystem for secure file handling
- **Real-time Updates** - Livewire for seamless user interactions
- **Responsive Design** - Mobile-first approach with Tailwind CSS
- **Dark Mode** - Built-in theme switching
- **Component Architecture** - Reusable Blade components

## 📊 Database Schema

### Core Models
- **Users** - Enhanced profiles with academic information
- **StudyMaterials** - Uploaded educational content
- **Tutors** - Tutor profiles and availability
- **Textbooks** - Marketplace listings
- **CampusEvents** - Event management
- **ForumPosts** - Discussion threads

### Relationship Models
- **StudyMaterialRatings** - Material ratings and reviews
- **TutorBookings** - Tutoring session management
- **EventRsvps** - Event attendance tracking
- **ForumVotes** - Community voting system

## 🎨 Key Features Showcase

### 📋 Smart Content Management
```php
// Study materials with comprehensive metadata
$material = StudyMaterial::create([
    'title' => 'Advanced Calculus Notes',
    'subject' => 'Mathematics',
    'course_code' => 'MATH301',
    'type' => 'notes',
    'professor' => 'Dr. Smith'
]);
```

### 🔍 Advanced Discovery
```php
// Community trending algorithm
$trending = StudyMaterial::where('created_at', '>=', now()->subDays(7))
    ->where('downloads', '>', 0)
    ->orderBy('downloads', 'desc')
    ->orderBy('rating', 'desc')
    ->get();
```

### 👤 Rich User Profiles
```php
// Enhanced user information
$user->update([
    'university' => 'National University of Mongolia',
    'major' => 'Computer Science',
    'year_of_study' => 'Junior',
    'interests' => ['AI', 'Web Development', 'Data Science'],
    'social_links' => [
        'linkedin' => 'https://linkedin.com/in/student',
        'github' => 'https://github.com/student'
    ]
]);
```

## 🛡️ Security Features

- **Authentication** - Secure user registration and login
- **Authorization** - Role-based access control
- **File Validation** - Secure file upload with type checking
- **CSRF Protection** - Built-in Laravel security
- **XSS Prevention** - Blade template escaping
- **SQL Injection Prevention** - Eloquent ORM protection

## 🎯 Use Cases

### For Students
- **Academic Success**: Access high-quality study materials from peers
- **Tutoring Support**: Find qualified tutors in your subjects
- **Cost Savings**: Buy, sell, or exchange textbooks at fair prices
- **Community Engagement**: Participate in discussions and events
- **Knowledge Sharing**: Contribute to the academic community

### For Tutors
- **Income Generation**: Monetize your academic expertise
- **Flexible Scheduling**: Set your own availability and rates
- **Reputation Building**: Build a profile with reviews and ratings
- **Subject Specialization**: Focus on your strongest subjects

### For Campus Organizations
- **Event Promotion**: Reach students effectively
- **Community Building**: Foster academic collaboration
- **Resource Sharing**: Centralized platform for educational content

## 🔧 Configuration

### Environment Variables
```bash
# Database
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite

# WorkOS Authentication
WORKOS_API_KEY=your_workos_api_key
WORKOS_CLIENT_ID=your_workos_client_id

# File Storage
FILESYSTEM_DISK=local
```

### Customization
- **Themes**: Modify Tailwind configuration in `tailwind.config.js`
- **Components**: Extend Flux UI components in `resources/views/components/`
- **Seeding**: Customize sample data in `database/seeders/CampusHubSeeder.php`

## 📈 Performance Optimizations

- **Lazy Loading** - Efficient relationship loading
- **Query Optimization** - Minimized N+1 queries
- **File Caching** - Optimized asset delivery
- **Database Indexing** - Fast search and filtering
- **Pagination** - Improved page load times

## 🤝 Contributing

We welcome contributions to Campus Hub! Here's how to get started:

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write descriptive commit messages
- Add tests for new features
- Update documentation as needed

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laravel Team** - For the amazing framework
- **Livewire Team** - For seamless frontend interactions
- **Flux UI** - For beautiful, accessible components
- **Tailwind CSS** - For utility-first styling
- **WorkOS** - For enterprise authentication

## 📞 Support

- **Documentation**: Check out our [Wiki](../../wiki)
- **Issues**: Report bugs via [GitHub Issues](../../issues)
- **Discussions**: Join our [GitHub Discussions](../../discussions)
- **Email**: 

---

<div align="center">

**🎓 Built with ❤️ for students, by students**

[Demo](https://demo.campushub.example.com) • [Documentation](../../wiki) • [Contributing](CONTRIBUTING.md) • [Changelog](CHANGELOG.md)

</div>