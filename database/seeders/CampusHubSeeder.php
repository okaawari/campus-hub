<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\StudyMaterial;
use App\Models\Tutor;
use App\Models\Textbook;
use App\Models\CampusEvent;
use App\Models\ForumPost;
use Illuminate\Database\Seeder;

class CampusHubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample users if they don't exist
        $existingUsers = User::count();
        if ($existingUsers < 10) {
            $users = User::factory()->count(10 - $existingUsers)->create();
        }
        $users = User::take(10)->get();

        // Create comprehensive study materials
        $studyMaterials = [
            // Mathematics Materials
            [
                'title' => 'Calculus I Complete Lecture Notes',
                'description' => 'Comprehensive notes covering limits, derivatives, and integrals with detailed examples and practice problems.',
                'subject' => 'Mathematics',
                'course_code' => 'MATH101',
                'professor' => 'Dr. Sarah Johnson',
                'type' => 'notes',
                'rating' => 4.8,
                'downloads' => 156,
            ],
            [
                'title' => 'Linear Algebra Final Exam - Spring 2024',
                'description' => 'Complete final exam with solutions covering vector spaces, eigenvalues, and linear transformations.',
                'subject' => 'Mathematics',
                'course_code' => 'MATH201',
                'professor' => 'Prof. Michael Chen',
                'type' => 'exam',
                'rating' => 4.6,
                'downloads' => 89,
            ],
            [
                'title' => 'Statistics Formula Cheat Sheet',
                'description' => 'Quick reference guide for probability, distributions, hypothesis testing, and statistical formulas.',
                'subject' => 'Mathematics',
                'course_code' => 'STAT301',
                'professor' => 'Dr. Emily Rodriguez',
                'type' => 'cheat_sheet',
                'rating' => 4.9,
                'downloads' => 234,
            ],
            
            // Computer Science Materials
            [
                'title' => 'Data Structures and Algorithms Notes',
                'description' => 'Detailed notes on arrays, linked lists, trees, graphs, and sorting algorithms with complexity analysis.',
                'subject' => 'Computer Science',
                'course_code' => 'CS201',
                'professor' => 'Dr. Alex Thompson',
                'type' => 'notes',
                'rating' => 4.7,
                'downloads' => 198,
            ],
            [
                'title' => 'Java Programming Flashcards',
                'description' => 'Comprehensive flashcards covering OOP concepts, collections, exceptions, and Java syntax.',
                'subject' => 'Computer Science',
                'course_code' => 'CS101',
                'professor' => 'Prof. Lisa Wang',
                'type' => 'flashcards',
                'rating' => 4.5,
                'downloads' => 167,
            ],
            [
                'title' => 'Database Systems Midterm Solutions',
                'description' => 'Complete midterm exam with detailed solutions covering SQL queries, normalization, and ER diagrams.',
                'subject' => 'Computer Science',
                'course_code' => 'CS301',
                'professor' => 'Dr. Robert Kim',
                'type' => 'exam',
                'rating' => 4.8,
                'downloads' => 112,
            ],
            [
                'title' => 'Machine Learning Study Guide',
                'description' => 'Comprehensive study guide covering supervised learning, neural networks, and model evaluation.',
                'subject' => 'Computer Science',
                'course_code' => 'CS401',
                'professor' => 'Dr. Maria Garcia',
                'type' => 'notes',
                'rating' => 4.9,
                'downloads' => 145,
            ],
            
            // Physics Materials
            [
                'title' => 'Classical Mechanics Problem Solutions',
                'description' => 'Step-by-step solutions to mechanics problems covering Newton\'s laws, work, and energy.',
                'subject' => 'Physics',
                'course_code' => 'PHYS101',
                'professor' => 'Dr. James Wilson',
                'type' => 'notes',
                'rating' => 4.6,
                'downloads' => 134,
            ],
            [
                'title' => 'Quantum Mechanics Formula Sheet',
                'description' => 'Essential formulas and equations for quantum mechanics including Schrödinger equation and operators.',
                'subject' => 'Physics',
                'course_code' => 'PHYS301',
                'professor' => 'Prof. Anna Lee',
                'type' => 'cheat_sheet',
                'rating' => 4.7,
                'downloads' => 98,
            ],
            
            // Chemistry Materials
            [
                'title' => 'Organic Chemistry Reaction Mechanisms',
                'description' => 'Detailed notes on SN1, SN2, E1, E2 reactions with examples and stereochemistry considerations.',
                'subject' => 'Chemistry',
                'course_code' => 'CHEM201',
                'professor' => 'Dr. David Brown',
                'type' => 'notes',
                'rating' => 4.8,
                'downloads' => 187,
            ],
            [
                'title' => 'General Chemistry Final Exam',
                'description' => 'Complete final exam covering stoichiometry, thermodynamics, and chemical bonding.',
                'subject' => 'Chemistry',
                'course_code' => 'CHEM101',
                'professor' => 'Dr. Jennifer Taylor',
                'type' => 'exam',
                'rating' => 4.5,
                'downloads' => 76,
            ],
            
            // Biology Materials
            [
                'title' => 'Cell Biology Flashcards',
                'description' => 'Comprehensive flashcards covering cell structure, organelles, and cellular processes.',
                'subject' => 'Biology',
                'course_code' => 'BIO101',
                'professor' => 'Dr. Patricia Miller',
                'type' => 'flashcards',
                'rating' => 4.6,
                'downloads' => 123,
            ],
            [
                'title' => 'Genetics Study Notes',
                'description' => 'Detailed notes on Mendelian inheritance, DNA structure, and genetic engineering.',
                'subject' => 'Biology',
                'course_code' => 'BIO201',
                'professor' => 'Dr. Kevin Davis',
                'type' => 'notes',
                'rating' => 4.7,
                'downloads' => 156,
            ],
            
            // Literature Materials
            [
                'title' => 'Shakespeare Analysis Guide',
                'description' => 'Comprehensive analysis of major Shakespeare plays with themes, characters, and literary devices.',
                'subject' => 'Literature',
                'course_code' => 'LIT201',
                'professor' => 'Dr. Elizabeth White',
                'type' => 'notes',
                'rating' => 4.8,
                'downloads' => 89,
            ],
            [
                'title' => 'Modern Poetry Exam Questions',
                'description' => 'Sample exam questions covering 20th-century poetry with analysis techniques.',
                'subject' => 'Literature',
                'course_code' => 'LIT301',
                'professor' => 'Prof. Mark Anderson',
                'type' => 'exam',
                'rating' => 4.4,
                'downloads' => 67,
            ],
            
            // History Materials
            [
                'title' => 'World War II Timeline',
                'description' => 'Comprehensive timeline with key events, battles, and political developments during WWII.',
                'subject' => 'History',
                'course_code' => 'HIST201',
                'professor' => 'Dr. Susan Clark',
                'type' => 'notes',
                'rating' => 4.5,
                'downloads' => 112,
            ],
            [
                'title' => 'American Revolution Flashcards',
                'description' => 'Key terms, dates, and figures from the American Revolutionary period.',
                'subject' => 'History',
                'course_code' => 'HIST101',
                'professor' => 'Prof. Richard Moore',
                'type' => 'flashcards',
                'rating' => 4.3,
                'downloads' => 78,
            ],
            
            // Economics Materials
            [
                'title' => 'Microeconomics Problem Set Solutions',
                'description' => 'Complete solutions to microeconomics problems covering supply, demand, and market structures.',
                'subject' => 'Economics',
                'course_code' => 'ECON101',
                'professor' => 'Dr. Thomas Jackson',
                'type' => 'notes',
                'rating' => 4.6,
                'downloads' => 145,
            ],
            [
                'title' => 'Macroeconomics Formula Reference',
                'description' => 'Essential formulas for GDP, inflation, unemployment, and fiscal policy calculations.',
                'subject' => 'Economics',
                'course_code' => 'ECON201',
                'professor' => 'Dr. Rachel Green',
                'type' => 'cheat_sheet',
                'rating' => 4.7,
                'downloads' => 98,
            ],
        ];

        foreach ($studyMaterials as $index => $material) {
            $user = $users[$index % $users->count()];
            $fileExtensions = ['pdf', 'doc', 'docx'];
            $fileType = fake()->randomElement($fileExtensions);
            
            StudyMaterial::create([
                'user_id' => $user->id,
                'title' => $material['title'],
                'description' => $material['description'],
                'subject' => $material['subject'],
                'course_code' => $material['course_code'],
                'professor' => $material['professor'],
                'file_path' => 'study-materials/' . time() . '_' . fake()->slug() . '.' . $fileType,
                'file_name' => fake()->slug() . '.' . $fileType,
                'file_type' => $fileType,
                'file_size' => fake()->numberBetween(500000, 8000000), // 500KB to 8MB
                'type' => $material['type'],
                'rating' => $material['rating'],
                'downloads' => $material['downloads'],
                'is_approved' => true,
            ]);
        }

        // Create sample tutors with more comprehensive data
        $tutorData = [
            [
                'subject' => 'Mathematics',
                'description' => 'Experienced math tutor specializing in calculus, algebra, and statistics. I help students understand complex concepts through clear explanations and practical examples. Patient and encouraging teaching style.',
                'hourly_rate' => 35.00,
                'qualifications' => 'Mathematics major with 3+ years tutoring experience. Former TA for Calculus I & II. Strong track record of helping students improve their grades.',
                'location' => 'Online',
                'rating' => 4.8,
                'total_sessions' => 127,
                'offers_free_session' => true,
            ],
            [
                'subject' => 'Computer Science',
                'description' => 'Software engineering student passionate about helping others learn programming. Expert in Python, Java, and web development. Great at breaking down complex algorithms.',
                'hourly_rate' => 40.00,
                'qualifications' => 'Computer Science major, 2 years industry experience, TA for Data Structures course. Built multiple web applications and mobile apps.',
                'location' => 'On-campus',
                'rating' => 4.9,
                'total_sessions' => 89,
                'offers_free_session' => false,
            ],
            [
                'subject' => 'Physics',
                'description' => 'Physics graduate student with deep understanding of mechanics, thermodynamics, and quantum physics. I make physics concepts accessible and fun to learn.',
                'hourly_rate' => 45.00,
                'qualifications' => 'PhD candidate in Physics, published researcher, 4 years teaching experience. Specializes in problem-solving techniques.',
                'location' => 'Library',
                'rating' => 4.7,
                'total_sessions' => 156,
                'offers_free_session' => true,
            ],
            [
                'subject' => 'Chemistry',
                'description' => 'Chemistry major with expertise in organic and inorganic chemistry. I help students master chemical reactions, lab techniques, and problem-solving strategies.',
                'hourly_rate' => 30.00,
                'qualifications' => 'Chemistry major, lab assistant for 2 years, tutor for General Chemistry courses. Strong background in analytical chemistry.',
                'location' => 'Student Center',
                'rating' => 4.6,
                'total_sessions' => 73,
                'offers_free_session' => false,
            ],
            [
                'subject' => 'Biology',
                'description' => 'Pre-med student with comprehensive knowledge of cell biology, genetics, and anatomy. I help students understand complex biological processes through visual aids and real-world examples.',
                'hourly_rate' => 32.00,
                'qualifications' => 'Biology major, MCAT score 95th percentile, research experience in molecular biology. TA for General Biology courses.',
                'location' => 'Online',
                'rating' => 4.8,
                'total_sessions' => 94,
                'offers_free_session' => true,
            ],
            [
                'subject' => 'Literature',
                'description' => 'English Literature graduate with passion for helping students analyze texts, write essays, and develop critical thinking skills. Expert in various literary periods and genres.',
                'hourly_rate' => 28.00,
                'qualifications' => 'English Literature major, published writer, 3 years tutoring experience. Specializes in essay writing and literary analysis.',
                'location' => 'Coffee Shop',
                'rating' => 4.7,
                'total_sessions' => 112,
                'offers_free_session' => false,
            ],
            [
                'subject' => 'History',
                'description' => 'History major with expertise in world history, American history, and political science. I help students understand historical context and develop analytical skills.',
                'hourly_rate' => 25.00,
                'qualifications' => 'History major, research assistant, 2 years tutoring experience. Strong background in primary source analysis and historical writing.',
                'location' => 'Library',
                'rating' => 4.5,
                'total_sessions' => 68,
                'offers_free_session' => true,
            ],
            [
                'subject' => 'Economics',
                'description' => 'Economics graduate student specializing in microeconomics, macroeconomics, and econometrics. I help students understand economic theories and their real-world applications.',
                'hourly_rate' => 38.00,
                'qualifications' => 'Economics PhD candidate, research experience, TA for Principles of Economics. Published papers in economic journals.',
                'location' => 'On-campus',
                'rating' => 4.9,
                'total_sessions' => 145,
                'offers_free_session' => false,
            ],
        ];

        $availabilityOptions = [
            [
                'monday' => ['9:00-12:00', '15:00-18:00'],
                'tuesday' => ['10:00-13:00', '16:00-19:00'],
                'wednesday' => ['9:00-12:00', '14:00-17:00'],
                'thursday' => ['10:00-13:00', '15:00-18:00'],
                'friday' => ['9:00-12:00', '14:00-17:00'],
                'saturday' => ['10:00-15:00'],
                'sunday' => ['14:00-18:00'],
            ],
            [
                'monday' => ['12:00-15:00', '18:00-21:00'],
                'tuesday' => ['9:00-12:00', '15:00-18:00'],
                'wednesday' => ['12:00-15:00', '18:00-21:00'],
                'thursday' => ['9:00-12:00', '16:00-19:00'],
                'friday' => ['12:00-15:00', '18:00-21:00'],
                'saturday' => ['9:00-14:00'],
                'sunday' => ['10:00-16:00'],
            ],
            [
                'monday' => ['9:00-17:00'],
                'tuesday' => ['10:00-16:00'],
                'wednesday' => ['9:00-17:00'],
                'thursday' => ['10:00-16:00'],
                'friday' => ['9:00-15:00'],
                'saturday' => [],
                'sunday' => [],
            ],
        ];

        foreach ($users->take(8) as $index => $user) {
            if ($index < count($tutorData)) {
                $tutor = $tutorData[$index];
                Tutor::create([
                    'user_id' => $user->id,
                    'subject' => $tutor['subject'],
                    'description' => $tutor['description'],
                    'hourly_rate' => $tutor['hourly_rate'],
                    'availability' => $availabilityOptions[$index % count($availabilityOptions)],
                    'location' => $tutor['location'],
                    'rating' => $tutor['rating'],
                    'total_sessions' => $tutor['total_sessions'],
                    'offers_free_session' => $tutor['offers_free_session'],
                    'qualifications' => $tutor['qualifications'],
                    'is_available' => true,
                ]);
            }
        }

        // Create sample textbooks
        $textbookData = [
            [
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen, Charles E. Leiserson',
                'isbn' => '978-0262033848',
                'edition' => '3rd Edition',
                'description' => 'Excellent condition textbook used for CS201. No highlights or notes, only minor shelf wear.',
                'condition' => 'good',
                'price' => 85.00,
                'listing_type' => 'sale',
                'course_code' => 'CS201',
                'subject' => 'Computer Science',
                'location' => 'Main Campus Library',
            ],
            [
                'title' => 'Calculus: Early Transcendentals',
                'author' => 'James Stewart',
                'isbn' => '978-1285741550',
                'edition' => '8th Edition',
                'description' => 'Like new condition. Barely used, perfect for MATH101. Includes access code.',
                'condition' => 'like_new',
                'price' => 120.00,
                'listing_type' => 'sale',
                'course_code' => 'MATH101',
                'subject' => 'Mathematics',
                'location' => 'Student Center',
            ],
            [
                'title' => 'University Physics',
                'author' => 'Hugh D. Young, Roger A. Freedman',
                'isbn' => '978-0133969290',
                'edition' => '14th Edition',
                'description' => 'Good condition with some highlighting. Great for PHYS301. Looking to trade for organic chemistry textbook.',
                'condition' => 'good',
                'price' => 0.00,
                'listing_type' => 'exchange',
                'course_code' => 'PHYS301',
                'subject' => 'Physics',
                'location' => 'Online',
            ],
            [
                'title' => 'Organic Chemistry',
                'author' => 'Paula Yurkanis Bruice',
                'isbn' => '978-0134042282',
                'edition' => '8th Edition',
                'description' => 'Fair condition with some notes. Perfect for CHEM102. Rent for the semester.',
                'condition' => 'fair',
                'price' => 45.00,
                'listing_type' => 'rent',
                'course_code' => 'CHEM102',
                'subject' => 'Chemistry',
                'location' => 'Chemistry Building',
            ],
            [
                'title' => 'Data Structures and Algorithms in Java',
                'author' => 'Robert Lafore',
                'isbn' => '978-0672324539',
                'edition' => '2nd Edition',
                'description' => 'New textbook still in shrink wrap. Bought for CS201 but course changed.',
                'condition' => 'new',
                'price' => 95.00,
                'listing_type' => 'sale',
                'course_code' => 'CS201',
                'subject' => 'Computer Science',
                'location' => 'Computer Science Building',
            ],
            [
                'title' => 'Linear Algebra and Its Applications',
                'author' => 'David C. Lay',
                'isbn' => '978-0321385178',
                'edition' => '4th Edition',
                'description' => 'Good condition with minimal wear. Used for MATH201. No highlighting.',
                'condition' => 'good',
                'price' => 75.00,
                'listing_type' => 'sale',
                'course_code' => 'MATH201',
                'subject' => 'Mathematics',
                'location' => 'Math Department',
            ],
            [
                'title' => 'Campbell Biology',
                'author' => 'Jane B. Reece, Lisa A. Urry',
                'isbn' => '978-0134093413',
                'edition' => '11th Edition',
                'description' => 'Like new condition. Barely used for BIO101. Includes all supplements.',
                'condition' => 'like_new',
                'price' => 110.00,
                'listing_type' => 'sale',
                'course_code' => 'BIO101',
                'subject' => 'Biology',
                'location' => 'Biology Building',
            ],
            [
                'title' => 'Principles of Economics',
                'author' => 'N. Gregory Mankiw',
                'isbn' => '978-1305585126',
                'edition' => '8th Edition',
                'description' => 'Fair condition with some highlighting. Good for ECON101. Looking to exchange for any math textbook.',
                'condition' => 'fair',
                'price' => 0.00,
                'listing_type' => 'exchange',
                'course_code' => 'ECON101',
                'subject' => 'Economics',
                'location' => 'Business School',
            ],
        ];

        foreach ($users->take(8) as $index => $user) {
            if ($index < count($textbookData)) {
                $textbook = $textbookData[$index];
                Textbook::create([
                    'user_id' => $user->id,
                    'title' => $textbook['title'],
                    'author' => $textbook['author'],
                    'isbn' => $textbook['isbn'],
                    'edition' => $textbook['edition'],
                    'description' => $textbook['description'],
                    'condition' => $textbook['condition'],
                    'price' => $textbook['price'],
                    'listing_type' => $textbook['listing_type'],
                    'course_code' => $textbook['course_code'],
                    'subject' => $textbook['subject'],
                    'images' => [],
                    'location' => $textbook['location'],
                    'is_available' => true,
                ]);
            }
        }

        // Create comprehensive campus events
        $eventTemplates = [
            // Academic Events
            [
                'title' => 'Machine Learning Workshop Series',
                'description' => 'Join us for a comprehensive 3-day workshop on machine learning fundamentals. Learn about algorithms, data preprocessing, and model evaluation. Perfect for beginners and intermediate students interested in AI.',
                'category' => 'academic',
                'organizer' => 'Computer Science Department',
                'location' => 'Computer Science Building, Room 101',
                'requires_rsvp' => true,
                'max_attendees' => 50,
                'contact_email' => 'cs-dept@university.edu',
                'is_featured' => true,
            ],
            [
                'title' => 'Research Methods Seminar',
                'description' => 'Dr. Sarah Johnson presents her latest research on sustainable energy solutions. Q&A session included. Coffee and refreshments provided.',
                'category' => 'academic',
                'organizer' => 'Physics Department',
                'location' => 'Physics Auditorium',
                'requires_rsvp' => false,
                'max_attendees' => null,
                'contact_email' => 'physics@university.edu',
                'is_featured' => false,
            ],
            [
                'title' => 'Mathematics Competition Finals',
                'description' => 'Watch the final round of our annual mathematics competition. Top students from across the university compete for scholarships and recognition.',
                'category' => 'academic',
                'organizer' => 'Math Club',
                'location' => 'Student Center, Main Hall',
                'requires_rsvp' => false,
                'max_attendees' => 300,
                'contact_email' => 'math-club@university.edu',
                'is_featured' => true,
            ],

            // Club Events
            [
                'title' => 'Photography Club Exhibition',
                'description' => 'Showcase of student photography work from this semester. Categories include nature, portrait, and abstract photography. Awards ceremony at the end.',
                'category' => 'club',
                'organizer' => 'Photography Club',
                'location' => 'Art Gallery',
                'requires_rsvp' => false,
                'max_attendees' => null,
                'contact_email' => 'photo-club@university.edu',
                'is_featured' => false,
            ],
            [
                'title' => 'Debate Society Tournament',
                'description' => 'Intramural debate tournament featuring teams from different colleges. Topics include current events, ethics, and policy. Spectators welcome!',
                'category' => 'club',
                'organizer' => 'Debate Society',
                'location' => 'Liberal Arts Building, Room 205',
                'requires_rsvp' => true,
                'max_attendees' => 80,
                'contact_email' => 'debate-society@university.edu',
                'is_featured' => false,
            ],

            // Sports Events
            [
                'title' => 'Intramural Basketball Championship',
                'description' => 'Final championship game between the top two intramural basketball teams. Half-time entertainment and concessions available.',
                'category' => 'sports',
                'organizer' => 'Athletics Department',
                'location' => 'Main Gymnasium',
                'requires_rsvp' => false,
                'max_attendees' => 500,
                'contact_email' => 'athletics@university.edu',
                'is_featured' => true,
            ],
            [
                'title' => 'Yoga & Mindfulness Session',
                'description' => 'Weekly yoga session focused on stress relief and mindfulness. All skill levels welcome. Mats provided.',
                'category' => 'sports',
                'organizer' => 'Wellness Center',
                'location' => 'Wellness Center, Studio A',
                'requires_rsvp' => true,
                'max_attendees' => 25,
                'contact_email' => 'wellness@university.edu',
                'is_featured' => false,
            ],

            // Job Fair Events
            [
                'title' => 'Tech Career Fair',
                'description' => 'Connect with leading technology companies for internships and full-time positions. Bring your resume and dress professionally.',
                'category' => 'job_fair',
                'organizer' => 'Career Services',
                'location' => 'Convention Center',
                'requires_rsvp' => true,
                'max_attendees' => 200,
                'contact_email' => 'career-services@university.edu',
                'is_featured' => true,
            ],
            [
                'title' => 'Startup Pitch Competition',
                'description' => 'Students present their startup ideas to a panel of industry experts. Prizes include funding opportunities and mentorship.',
                'category' => 'job_fair',
                'organizer' => 'Entrepreneurship Club',
                'location' => 'Business School Auditorium',
                'requires_rsvp' => false,
                'max_attendees' => 150,
                'contact_email' => 'entrepreneurship@university.edu',
                'is_featured' => false,
            ],

            // Seminar Events
            [
                'title' => 'Climate Change and Sustainability',
                'description' => 'Expert panel discussion on climate change impacts and sustainable solutions. Featuring faculty from Environmental Science and Policy departments.',
                'category' => 'seminar',
                'organizer' => 'Environmental Studies Department',
                'location' => 'Environmental Science Building, Lecture Hall',
                'requires_rsvp' => true,
                'max_attendees' => 100,
                'contact_email' => 'env-studies@university.edu',
                'is_featured' => true,
            ],
            [
                'title' => 'Digital Marketing Trends 2024',
                'description' => 'Industry expert shares insights on the latest digital marketing trends, social media strategies, and consumer behavior patterns.',
                'category' => 'seminar',
                'organizer' => 'Marketing Association',
                'location' => 'Business School, Room 150',
                'requires_rsvp' => false,
                'max_attendees' => 75,
                'contact_email' => 'marketing-assoc@university.edu',
                'is_featured' => false,
            ],

            // Social Events
            [
                'title' => 'Spring Festival',
                'description' => 'Annual spring celebration with live music, food trucks, games, and activities. Rain or shine event!',
                'category' => 'social',
                'organizer' => 'Student Activities Board',
                'location' => 'Central Quad',
                'requires_rsvp' => false,
                'max_attendees' => null,
                'contact_email' => 'activities@university.edu',
                'is_featured' => true,
            ],
            [
                'title' => 'International Food Night',
                'description' => 'Experience cuisines from around the world prepared by international students. Cultural performances and music included.',
                'category' => 'social',
                'organizer' => 'International Student Association',
                'location' => 'Student Center, Dining Hall',
                'requires_rsvp' => true,
                'max_attendees' => 120,
                'contact_email' => 'international-students@university.edu',
                'is_featured' => false,
            ],
            [
                'title' => 'Movie Night: Classic Films',
                'description' => 'Screening of classic films with popcorn and refreshments. This week: "Casablanca" (1942). Discussion follows the screening.',
                'category' => 'social',
                'organizer' => 'Film Society',
                'location' => 'Student Center, Theater',
                'requires_rsvp' => false,
                'max_attendees' => 200,
                'contact_email' => 'film-society@university.edu',
                'is_featured' => false,
            ],

            // Other Events
            [
                'title' => 'Library Study Marathon',
                'description' => '24-hour study marathon with coffee, snacks, and study groups. Perfect for final exam preparation. Quiet and group study areas available.',
                'category' => 'other',
                'organizer' => 'Library Services',
                'location' => 'Main Library',
                'requires_rsvp' => false,
                'max_attendees' => null,
                'contact_email' => 'library@university.edu',
                'is_featured' => false,
            ],
            [
                'title' => 'Blood Drive',
                'description' => 'Community blood drive organized by the Red Cross. Every donation helps save lives. Walk-ins welcome, but appointments preferred.',
                'category' => 'other',
                'organizer' => 'Community Service Club',
                'location' => 'Student Health Center',
                'requires_rsvp' => true,
                'max_attendees' => 50,
                'contact_email' => 'community-service@university.edu',
                'is_featured' => true,
            ],
        ];

        foreach ($eventTemplates as $template) {
            // Create events with varied timing
            $startTime = fake()->dateTimeBetween('now', '+3 months');
            $endTime = clone $startTime;
            
            // Adjust duration based on event type
            if ($template['category'] === 'seminar' || $template['category'] === 'academic') {
                $endTime->modify('+' . fake()->numberBetween(1, 3) . ' hours');
            } elseif ($template['category'] === 'sports') {
                $endTime->modify('+' . fake()->numberBetween(2, 4) . ' hours');
            } elseif ($template['category'] === 'social') {
                $endTime->modify('+' . fake()->numberBetween(3, 6) . ' hours');
            } else {
                $endTime->modify('+' . fake()->numberBetween(1, 4) . ' hours');
            }

            $user = $users->random();
            
            CampusEvent::create([
                'user_id' => $user->id,
                'title' => $template['title'],
                'description' => $template['description'],
                'start_time' => $startTime,
                'end_time' => $endTime,
                'location' => $template['location'],
                'category' => $template['category'],
                'organizer' => $template['organizer'],
                'max_attendees' => $template['max_attendees'],
                'requires_rsvp' => $template['requires_rsvp'],
                'contact_email' => $template['contact_email'],
                'image_url' => fake()->boolean(30) ? fake()->imageUrl(800, 600, 'events') : null,
                'is_featured' => $template['is_featured'],
            ]);
        }

        // Create some additional random events
        foreach ($users->take(5) as $user) {
            $startTime = fake()->dateTimeBetween('now', '+2 months');
            $endTime = clone $startTime;
            $endTime->modify('+' . fake()->numberBetween(1, 4) . ' hours');
            
            CampusEvent::create([
                'user_id' => $user->id,
                'title' => fake()->sentence(3),
                'description' => fake()->paragraph(3),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'location' => fake()->randomElement(['Library', 'Student Center', 'Academic Building', 'Online', 'Gymnasium', 'Auditorium']),
                'category' => fake()->randomElement(['academic', 'club', 'sports', 'job_fair', 'seminar', 'social', 'other']),
                'organizer' => fake()->randomElement(['Math Club', 'CS Department', 'Student Government', 'Career Services', 'Athletics', 'Art Department']),
                'max_attendees' => fake()->boolean(60) ? fake()->numberBetween(10, 100) : null,
                'requires_rsvp' => fake()->boolean(70),
                'contact_email' => fake()->email(),
                'image_url' => fake()->boolean(20) ? fake()->imageUrl(800, 600, 'events') : null,
                'is_featured' => fake()->boolean(15),
            ]);
        }

        // Create realistic forum posts
        $forumPosts = [
            // Mathematics Questions
            [
                'title' => 'Help with Calculus II Integration by Parts',
                'content' => "I'm struggling with integration by parts in my Calculus II class. Specifically, I can't figure out how to solve ∫x²e^x dx. I understand the formula ∫u dv = uv - ∫v du, but I'm not sure how to choose u and dv for this problem.\n\nCan someone walk me through the steps? I've tried setting u = x² and dv = e^x dx, but I keep getting stuck in the second integration.\n\nThanks in advance for any help!",
                'category' => 'question',
                'subject' => 'Mathematics',
                'course_code' => 'MATH201',
                'views' => 45,
                'upvotes' => 8,
                'is_solved' => true,
                'is_pinned' => false,
            ],
            [
                'title' => 'Linear Algebra: Understanding Eigenvalues and Eigenvectors',
                'content' => "I'm having trouble understanding the geometric interpretation of eigenvalues and eigenvectors. I can compute them mathematically, but I don't really 'see' what they represent.\n\nCan someone explain this concept in simple terms? Maybe with a visual example or analogy?\n\nAlso, why are they so important in applications like machine learning and computer graphics?",
                'category' => 'question',
                'subject' => 'Mathematics',
                'course_code' => 'MATH301',
                'views' => 67,
                'upvotes' => 12,
                'is_solved' => false,
                'is_pinned' => false,
            ],
            
            // Computer Science Discussions
            [
                'title' => 'Best Programming Languages for Beginners in 2024',
                'content' => "I'm a freshman CS major and I want to start learning programming. I've heard different opinions about which language to start with - Python, Java, C++, JavaScript...\n\nWhat would you recommend for someone just starting out? I'm interested in eventually doing web development and maybe some data science.\n\nAlso, what resources would you suggest for learning? I've heard about freeCodeCamp and Codecademy, but are there other good options?",
                'category' => 'discussion',
                'subject' => 'Computer Science',
                'course_code' => 'CS101',
                'views' => 123,
                'upvotes' => 15,
                'is_solved' => false,
                'is_pinned' => false,
            ],
            [
                'title' => 'Data Structures and Algorithms Study Group',
                'content' => "Hey everyone! I'm organizing a study group for Data Structures and Algorithms (CS301). We'll meet twice a week to work through problems, discuss concepts, and prepare for technical interviews.\n\nSchedule:\n- Tuesdays 6-8 PM in the CS lab\n- Thursdays 4-6 PM in the library study room\n\nWe'll focus on:\n- Arrays, Linked Lists, Stacks, Queues\n- Trees and Graphs\n- Sorting and Searching algorithms\n- Dynamic Programming basics\n\nAll skill levels welcome! Bring your laptops and let's learn together. DM me if you're interested!",
                'category' => 'announcement',
                'subject' => 'Computer Science',
                'course_code' => 'CS301',
                'views' => 89,
                'upvotes' => 22,
                'is_solved' => false,
                'is_pinned' => true,
            ],
            
            // Physics Questions
            [
                'title' => 'Quantum Mechanics: Wave-Particle Duality Confusion',
                'content' => "I'm really struggling to understand wave-particle duality in my Quantum Mechanics class. How can something be both a wave AND a particle at the same time? This seems contradictory to me.\n\nI understand the double-slit experiment conceptually, but I can't wrap my head around the underlying physics. Can someone explain this in terms that make sense?\n\nAlso, does this mean that everything has wave properties, or just subatomic particles?",
                'category' => 'question',
                'subject' => 'Physics',
                'course_code' => 'PHYS401',
                'views' => 34,
                'upvotes' => 6,
                'is_solved' => false,
                'is_pinned' => false,
            ],
            
            // Chemistry Help
            [
                'title' => 'Organic Chemistry: SN1 vs SN2 Reactions',
                'content' => "I need help distinguishing between SN1 and SN2 reactions in organic chemistry. I understand the basic mechanisms, but I keep getting confused about when to use which one.\n\nCan someone provide a clear comparison with examples? What are the key factors that determine which mechanism will occur?\n\nI have a quiz tomorrow and I'm really stressed about this topic. Any help would be greatly appreciated!",
                'category' => 'question',
                'subject' => 'Chemistry',
                'course_code' => 'CHEM201',
                'views' => 56,
                'upvotes' => 9,
                'is_solved' => true,
                'is_pinned' => false,
            ],
            
            // Biology Discussion
            [
                'title' => 'CRISPR Gene Editing: Ethical Implications Discussion',
                'content' => "With the recent advances in CRISPR technology, I've been thinking a lot about the ethical implications of gene editing. On one hand, it could cure genetic diseases and improve human health. On the other hand, there are concerns about designer babies and genetic inequality.\n\nWhat are your thoughts on this? Should there be limits on what we can edit? Who should decide these limits?\n\nI'm writing a paper on this topic for my Bioethics class and would love to hear different perspectives from fellow students.",
                'category' => 'discussion',
                'subject' => 'Biology',
                'course_code' => 'BIO301',
                'views' => 78,
                'upvotes' => 11,
                'is_solved' => false,
                'is_pinned' => false,
            ],
            
            // Literature Discussion
            [
                'title' => "Shakespeare's Hamlet: Modern Relevance",
                'content' => "We're studying Hamlet in my Literature class, and I'm curious about how this 400-year-old play remains relevant today. The themes of revenge, madness, and moral corruption seem timeless.\n\nWhat do you think makes Hamlet so enduring? Are there modern works (books, movies, TV shows) that explore similar themes?\n\nI'm particularly interested in the psychological aspects of the play. Hamlet's internal conflict and his relationship with his mother seem very modern to me.",
                'category' => 'discussion',
                'subject' => 'Literature',
                'course_code' => 'LIT201',
                'views' => 42,
                'upvotes' => 7,
                'is_solved' => false,
                'is_pinned' => false,
            ],
            
            // History Questions
            [
                'title' => 'World War II: Causes and Consequences Essay Help',
                'content' => "I'm working on a major essay about the causes and consequences of World War II for my History class. I have a good understanding of the main events, but I'm struggling to organize my thoughts into a coherent argument.\n\nMy thesis is that WWII was caused by a combination of unresolved issues from WWI, economic instability, and the rise of totalitarian regimes. Does this sound reasonable?\n\nI'm also having trouble finding good primary sources. Any suggestions for reliable sources I should look at?",
                'category' => 'question',
                'subject' => 'History',
                'course_code' => 'HIST201',
                'views' => 29,
                'upvotes' => 4,
                'is_solved' => false,
                'is_pinned' => false,
            ],
            
            // Economics Help
            [
                'title' => 'Microeconomics: Supply and Demand Elasticity',
                'content' => "I'm confused about price elasticity of demand and supply in my Microeconomics class. I understand the basic concept, but I'm having trouble calculating it and understanding what the numbers mean.\n\nFor example, if the price elasticity of demand is -2, what does that tell us about consumer behavior? And how do I know if demand is elastic, inelastic, or unit elastic?\n\nCan someone explain this with a simple example? Maybe using a product like coffee or smartphones?",
                'category' => 'question',
                'subject' => 'Economics',
                'course_code' => 'ECON101',
                'views' => 38,
                'upvotes' => 5,
                'is_solved' => true,
                'is_pinned' => false,
            ],
            
            // General Help Posts
            [
                'title' => 'Study Tips for Finals Week',
                'content' => "Finals week is approaching and I wanted to share some study tips that have worked well for me:\n\n1. **Create a study schedule** - Break down your subjects and allocate specific time slots\n2. **Use active recall** - Don't just re-read notes, test yourself\n3. **Form study groups** - Teaching others helps solidify your understanding\n4. **Take breaks** - The Pomodoro technique (25 min study, 5 min break) works great\n5. **Get enough sleep** - Cramming all night usually backfires\n6. **Stay hydrated and eat well** - Your brain needs fuel!\n\nWhat study strategies work best for you? Let's help each other succeed!",
                'category' => 'help',
                'subject' => null,
                'course_code' => null,
                'views' => 156,
                'upvotes' => 28,
                'is_solved' => false,
                'is_pinned' => true,
            ],
            [
                'title' => 'Campus Resources for Mental Health Support',
                'content' => "I wanted to share some important resources for anyone who might be struggling with stress, anxiety, or other mental health concerns:\n\n**Counseling Center**: Free individual and group counseling sessions\n**Crisis Hotline**: 24/7 support available\n**Wellness Workshops**: Stress management, mindfulness, and study skills\n**Peer Support Groups**: Connect with other students facing similar challenges\n\nRemember, it's okay to ask for help. You're not alone, and seeking support is a sign of strength, not weakness.\n\nIf you're in immediate crisis, please reach out to the counseling center or call the crisis hotline. Your mental health matters.",
                'category' => 'announcement',
                'subject' => null,
                'course_code' => null,
                'views' => 203,
                'upvotes' => 35,
                'is_solved' => false,
                'is_pinned' => true,
            ],
        ];

        // Create the forum posts
        foreach ($forumPosts as $postData) {
            $user = $users->random();
            ForumPost::create(array_merge($postData, ['user_id' => $user->id]));
        }

        // Create some additional random posts
        foreach ($users->take(4) as $user) {
            ForumPost::create([
                'user_id' => $user->id,
                'title' => fake()->sentence(4),
                'content' => fake()->paragraphs(2, true),
                'category' => fake()->randomElement(['question', 'discussion', 'announcement', 'help']),
                'subject' => fake()->randomElement(['Mathematics', 'Computer Science', 'Physics', 'Chemistry', 'Biology', 'Literature', 'History', 'Economics']),
                'course_code' => fake()->randomElement(['MATH101', 'CS201', 'PHYS301', 'CHEM102', 'BIO101', 'LIT201', 'HIST101', 'ECON101']),
                'views' => fake()->numberBetween(5, 50),
                'upvotes' => fake()->numberBetween(0, 10),
                'is_solved' => fake()->boolean(25),
                'is_pinned' => false,
            ]);
        }
    }
}