-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2025 at 02:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_clubs_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','editor') DEFAULT 'editor',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `name`, `role`, `created_at`) VALUES
(2, 'admin', '$2y$10$jLK.aJ4Eq0jnVsv1pIYUfeCRL4U9BbgiwABUHY/F.hx.YkPHjfm4e', 'Super Admin', 'superadmin', '2025-11-20 20:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name`, `description`, `logo`, `created_at`) VALUES
(3, 'Photography Club', 'The Photography Club is a creative space for students who love capturing moments, exploring visual storytelling, and expressing themselves through the lens. Whether you use a professional camera or just your phone, this club helps you learn the art and techniques of photography in a fun and supportive environment.\n\nMembers participate in photo walks, workshops, editing sessions, competitions, and exhibitions. You get hands-on experience with topics like portrait photography, nature shots, event coverage, street photography, lighting, and photo editing tools.\n\nThe club encourages creativity, improves technical skills, and helps students build a strong photography portfolio. If you enjoy clicking pictures, experimenting with angles, or telling stories through images — the Photography Club is the perfect place to grow and share your passion.', 'photography.jpg', '2025-01-15 15:32:00'),
(4, 'Music & Bands Club', 'The Music & Bands Club is the heart of rhythm, melody, and creativity on campus. It brings together students who are passionate about singing, playing instruments, composing music, or performing live. Whether you\'re a beginner or an experienced musician, this club gives you the platform to explore your musical talents and grow with others who share the same passion.\n\nMembers get opportunities to participate in jam sessions, band formations, music workshops, open-mic events, college fests, and live performances. The club covers all styles — from classical and acoustic to rock, pop, jazz, and fusion.\n\nThe goal of the club is to create a welcoming space where students can express themselves, collaborate with others, and experience the joy of making music. If music fuels your soul, the Music & Bands Club is the perfect stage for you.', 'music.jpg', '2025-01-18 19:10:00'),
(5, 'Fitness & Wellness Club', 'The Fitness & Wellness Club is dedicated to helping students build a healthy, active, and balanced lifestyle. This club promotes physical fitness, mental well-being, and overall personal growth through fun and supportive activities.\n\nMembers participate in gym workouts, yoga sessions, Zumba, morning runs, sports conditioning, meditation, nutrition talks, and wellness workshops. The club encourages students to stay active, reduce stress, and develop healthy habits that support both physical and mental health.\n\nWhether your goal is to stay fit, relieve stress, learn healthy routines, or simply connect with others who value wellness, the Fitness & Wellness Club offers a positive and energetic environment for all fitness levels. It’s the perfect space to refresh your mind, strengthen your body, and feel your best every day.', 'fitness.jpg', '2025-02-01 14:00:00'),
(6, 'Robotics & Engineering Club', 'The Robotics & Engineering Club is a hub for students who love building, designing, and experimenting with technology. The club brings together innovators, problem-solvers, and future engineers who enjoy working with robots, electronics, sensors, circuits, and real-world engineering challenges.\n\nMembers get hands-on experience through robot-building workshops, coding sessions, electronics projects, automation challenges, drone activities, and inter-college robotics competitions. The club also introduces students to technologies like Arduino, Raspberry Pi, microcontrollers, robotics algorithms, 3D printing, and AI-based automation.\n\nThe mission of this club is to spark creativity, develop engineering skills, and encourage teamwork while exploring the endless possibilities of robotics and modern technology. Whether you\'re a beginner or a tech enthusiast, the Robotics & Engineering Club gives you the perfect space to learn, innovate, and bring ideas to life.', 'robotics.png', '2025-02-05 17:45:00'),
(7, 'Film & Media Club', 'The Film & Media Club is a dynamic space for students who are passionate about filmmaking, video production, editing, photography, storytelling, and digital media. Whether you dream of being behind the camera, directing, acting, writing scripts, or mastering editing tools — this club helps you explore and grow your media skills.\n\nMembers engage in exciting activities such as short-film making, editing workshops, scriptwriting sessions, media production challenges, film screenings, and content creation projects. You’ll get hands-on experience with cameras, lighting setups, editing software, and storytelling techniques used in the media industry.\n\nThe club encourages creativity, teamwork, and innovation while helping students build strong portfolios for future careers in film, media, journalism, entertainment, and digital content creation. If visual storytelling excites you, the Film & Media Club is the perfect place to learn, create, and bring your ideas to life.', 'film.jpg', '2025-02-07 21:20:00'),
(8, 'Coding & Tech Club', 'The Coding & Tech Club is a community for students who are passionate about programming, technology, and innovation. Our club provides a friendly and collaborative space where beginners and advanced learners can improve their coding skills, build real projects, and explore modern technologies.\n\nWe regularly host coding workshops, tech talks, hackathons, and project-building sessions to help students gain hands-on experience. Members learn about topics like web development, app development, databases, cybersecurity, AI, cloud computing, and much more.\n\nThe goal of the club is to create a supportive environment where students can learn together, share ideas, and grow as future developers and technology professionals. Whether you are just starting your tech journey or already have experience, the Coding & Tech Club welcomes everyone who wants to learn, create, and innovate.', 'coding.jpg', '2025-02-10 16:22:00'),
(9, 'Cultural Activities Club', 'The Cultural Activities Club is a vibrant and inclusive space where students celebrate creativity, diversity, and cultural expression. The club brings together individuals who enjoy dance, music, drama, art, literature, and traditional performances.\n\nMembers actively participate in cultural festivals, talent shows, art competitions, drama acts, workshops, and community events, promoting unity and creativity across campus. The club encourages students to explore different cultures, express their artistic side, and build confidence through performance and collaboration.\n\nWhether you love performing on stage, creating artwork, or simply appreciating cultural traditions, the Cultural Activities Club welcomes everyone who wants to be part of a lively, energetic, and culturally rich community.', 'cultural.jpg', '2025-02-11 20:30:00'),
(10, 'Debate & Public Speaking Club', 'The Debate & Public Speaking Club is a platform for students who want to improve their communication skills, boost their confidence, and develop strong critical-thinking abilities. The club provides a supportive environment where members practice debates, speeches, group discussions, presentations, and storytelling.\n\nStudents participate in engaging activities such as mock debates, parliamentary debates, extempore speaking, persuasive speech drills, voice-modulation sessions, and inter-college competitions. The club helps members learn how to express their ideas clearly, think quickly, and speak confidently in front of an audience.\n\nWhether you’re aiming to improve your communication for academics, future careers, interviews, or personal growth, the Debate & Public Speaking Club helps every student become a powerful and effective speaker.', 'debate.jpg', '2025-02-12 15:10:00'),
(11, 'Environmental Awareness Club', 'The Environmental Awareness Club is dedicated to promoting sustainability, environmental responsibility, and eco-friendly habits among students. The club encourages everyone to understand the importance of protecting nature and taking small steps that make a big impact on our planet.\n\nMembers participate in activities such as campus cleanups, tree-plantation drives, recycling campaigns, awareness workshops, nature walks, paper-saving initiatives, and environmental poster competitions. The club also spreads awareness about topics like climate change, pollution control, biodiversity, conservation, and green living.\n\nThe goal of the club is to build a community of students who care about the environment and are motivated to take positive action. Whether you’re passionate about nature or simply want to make the world greener, the Environmental Awareness Club is the perfect place to learn, contribute, and inspire change.', 'environment.jpg', '2025-02-15 18:18:00'),
(12, 'Literature & Book Club', 'The Literature & Book Club is a welcoming space for students who love reading, writing, storytelling, and exploring the beauty of literature. The club brings together book lovers who enjoy discussing novels, poetry, essays, and all forms of written expression.\n\nMembers participate in book discussions, poetry readings, creative writing sessions, storytelling circles, literary quizzes, author spotlights, and book-exchange events. The club encourages students to share their thoughts, broaden their imagination, and develop a deeper appreciation for classic and contemporary literature.\n\nWhether you\'re a passionate reader, an aspiring writer, or someone who simply enjoys meaningful conversations, the Literature & Book Club offers a peaceful and inspiring environment where ideas come alive through words.', 'books.jpg', '2025-02-20 14:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `club_memberships`
--

CREATE TABLE `club_memberships` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `club_id`, `title`, `event_date`, `location`, `poster`, `created_at`, `description`) VALUES
(1, 3, 'DSLR Basics & Photography Tips', '2025-11-02', 'Room B204', 'event_poster2.png', '2025-02-15 16:00:00', 'Learn the basics of DSLR handling, lighting, composition, and photography techniques with hands-on practice.'),
(2, 4, 'Spring Jam Session 2025', '2025-10-10', 'Auditorium Hall', 'event_poster2.png', '2025-02-18 19:30:00', 'Musicians and singers come together for an open jam session featuring acoustic, electric, and percussion artists.'),
(3, 5, 'Outdoor Fitness Bootcamp', '2025-10-20', 'Central Field', 'event_poster2.png', '2025-02-20 15:15:00', 'A high-energy fitness bootcamp focusing on cardio, strength training, and endurance-building exercises.'),
(4, 6, 'Robotics Expo & Demonstration', '2025-11-02', 'Tech Lab 1', 'event_poster2.png', '2025-02-22 18:00:00', 'Explore student-built robots, automation projects, AI bots, and live demonstrations of engineering innovations.'),
(5, 7, 'Film & Media Screening Night', '2025-11-08', 'Media Room 203', 'event_poster2.png', '2025-02-25 22:10:00', 'Enjoy a collection of short films created by students, followed by discussions with filmmakers.'),
(6, 8, '24-Hour Hackathon Challenge', '2025-11-15', 'Innovation Hub', 'event_poster2.png', '2025-02-28 21:40:00', 'A competitive 24-hour hackathon for developers to build creative solutions and demonstrate programming skills.'),
(7, 9, 'Cultural Festival 2025', '2025-11-20', 'Main Courtyard', 'event_poster2.png', '2025-03-01 16:55:00', 'Celebrate traditions with cultural performances, international foods, and student showcases.'),
(8, 10, 'Inter-College Debate Championship', '2025-11-25', 'Conference Hall', 'event_poster2.png', '2025-03-03 14:40:00', 'Top debaters compete in structured formats with judges evaluating arguments, logic, and presentation.'),
(9, 11, 'Earth Day Tree Plantation', '2025-11-22', 'Green Park', 'event_poster2.png', '2025-03-05 13:22:00', 'Join the environmental club to plant trees, learn about sustainability, and contribute to a greener campus.'),
(10, 12, 'Literature Open Mic', '2025-11-24', 'Library Lounge', 'event_poster2.png', '2025-03-08 15:50:00', 'An open platform for students to share poetry, short stories, spoken word, and creative writings.');

-- --------------------------------------------------------

--
-- Table structure for table `event_photos`
--

CREATE TABLE `event_photos` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_photos`
--

INSERT INTO `event_photos` (`id`, `event_id`, `photo`, `created_at`) VALUES
(1, 10, '1763777081_Screenshot 2024-10-03 001145.png', '2025-11-22 02:04:41'),
(2, 10, '1763777081_Screenshot 2024-10-03 001721.png', '2025-11-22 02:04:41'),
(3, 10, '1763777081_Screenshot 2024-10-03 001845.png', '2025-11-22 02:04:41'),
(4, 10, '1763777081_Screenshot 2024-10-03 002324.png', '2025-11-22 02:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `event_id`, `name`, `email`, `created_at`) VALUES
(1, 5, 'Manpreet ', 'abc@gmail.com', '2025-11-24 08:55:50'),
(2, 5, 'Manpreet ', 'abc@gmail.com', '2025-11-24 08:57:48'),
(4, 2, 'Manpreet Kaur', 'a@gmail.com', '2025-11-24 22:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `club_id`, `name`, `role`, `profile_photo`, `created_at`) VALUES
(3, 3, 'Aarav Singh', 'Photographer', 'member.png', '2025-11-22 01:52:11'),
(4, 3, 'Mia Roberts', 'Editor', 'member2.jpg', '2025-11-22 01:52:11'),
(5, 4, 'Daniel Kim', 'Guitarist', 'member3.png', '2025-11-22 01:52:11'),
(6, 4, 'Sophia Turner', 'Vocalist', 'member.png', '2025-11-22 01:52:11'),
(7, 5, 'Kevin Brooks', 'Trainer', 'member2.jpg', '2025-11-22 01:52:11'),
(8, 5, 'Emily Harris', 'Yoga Instructor', 'member3.png', '2025-11-22 01:52:11'),
(9, 6, 'Liam Thompson', 'Robotics Engineer', 'member2.jpg', '2025-11-22 01:52:11'),
(10, 6, 'Aisha Patel', 'AI Programmer', 'member.png', '2025-11-22 01:52:11'),
(11, 7, 'Olivia Martinez', 'Cinematographer', 'member3.png', '2025-11-22 01:52:11'),
(12, 7, 'Jacob Wilson', 'Screenwriter', 'member2.jpg', '2025-11-22 01:52:11'),
(13, 8, 'Ethan Chen', 'Full Stack Developer', 'member3.png', '2025-11-22 01:52:11'),
(14, 8, 'Sarah Lee', 'UI/UX Designer', 'member.png', '2025-11-22 01:52:11'),
(15, 9, 'Priya Sharma', 'Dance Lead', 'member3.png', '2025-11-22 01:52:11'),
(16, 9, 'Lucas White', 'Event Coordinator', 'member.png', '2025-11-22 01:52:11'),
(17, 10, 'Aiden Green', 'Lead Debater', 'member2.jpg', '2025-11-22 01:52:11'),
(18, 10, 'Chloe Adams', 'Public Speaker', 'member3.png', '2025-11-22 01:52:11'),
(19, 11, 'Noah Williams', 'Eco Volunteer', 'member2.jpg', '2025-11-22 01:52:11'),
(20, 11, 'Grace Young', 'Sustainability Lead', 'member3.png', '2025-11-22 01:52:11'),
(21, 12, 'Emma Brown', 'Poet', 'member.png', '2025-11-22 01:52:11'),
(22, 12, 'Benjamin Scott', 'Author', 'member3.png', '2025-11-22 01:52:11'),
(23, 5, 'abcdd', 'Visitorass', '1763963664_Screenshot 2024-10-03 001145.png', '2025-11-24 05:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'a@gmail.com', '2025-11-24 22:26:26'),
(2, 'ar@gmail.com', '2025-11-24 22:38:00'),
(3, 'ar@gmail.com', '2025-11-24 22:38:48'),
(4, 'ar@gmail.com', '2025-11-24 22:40:00'),
(5, 'ar@gmail.com', '2025-11-24 22:40:18'),
(6, 'ar@gmail.com', '2025-11-24 22:41:13'),
(7, 'ar@gmail.com', '2025-11-24 22:41:26'),
(8, 'ar@gmail.com', '2025-11-24 22:41:54'),
(9, 'ar@gmail.com', '2025-11-24 22:42:06'),
(10, 'ar@gmail.com', '2025-11-24 22:42:13'),
(11, 'ar@gmail.com', '2025-11-24 22:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Manpreet Kaur', 'abc@gmail.com', '$2y$10$UOcJYNTMmRXNJYEuJ3S1LOX2.sxBEZEr5umqPYxeSFlZ62yym96oq', '2025-11-24 18:03:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_memberships`
--
ALTER TABLE `club_memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `event_photos`
--
ALTER TABLE `event_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `club_memberships`
--
ALTER TABLE `club_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `event_photos`
--
ALTER TABLE `event_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club_memberships`
--
ALTER TABLE `club_memberships`
  ADD CONSTRAINT `club_memberships_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `club_memberships_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_photos`
--
ALTER TABLE `event_photos`
  ADD CONSTRAINT `event_photos_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
