# HireMate

HireMate is a recruitment platform designed to streamline the job search and hiring process. Built with Laravel, Livewire, Alpine.js, and Tailwind CSS, this platform offers both job seekers and employers a comprehensive toolset to manage profiles, applications, and community interactions.

## Table of Contents

- [Features](#Features)
- [Technologies Used](#Technologies-Used)
- [Visuals](#Visuals)
- [Installation](#Installation)
- [Usage](#Usage)
- [Support](#Support)
- [Roadmap](#Roadmap)
- [Contributing](#Contributing)
- [Authors and Acknowledgment](#Authors-and-Acknowledgment)
- [License](#license)

## Features

- **Landing Page:** A welcoming introduction to the platform.
- **Home Page:**
  - **For You:** Tailored job suggestions.
  - **Search Section:** Find jobs that match your criteria.
  - **Activity Section:** View recent activity, including consulted posts, liked jobs, and application statuses (Pending, Refused, Accepted).
- **Profile Page:** Customize your profile with details like name, email, phone number, and demographic information. 
- **Settings Page:** Manage profile information, candidate data, work experience, education, and account security.
- **Job Seeking Page:** Create and edit job posts seeking new opportunities.
- **Community Page:** Engage with posts, questions, and opinions from other users. (Only available for job seekers.)
- **Dark/Light Mode:** Choose between a dark or light theme.



## Technologies Used

- **Laravel**: Back-end framework.
- **Livewire**: Reactive components for dynamic user interfaces.
- **Alpine.js**: Minimal JavaScript framework for interactivity.
- **Tailwind CSS**: Utility-first CSS framework for styling.

## Visuals

### Landing page
![HireMate Screenshot](screenshots/landing-page.png)

### Login page
![HireMate Screenshot](screenshots/login-page.png)

### Home page
![HireMate Screenshot](screenshots/home.jpeg)

### Search page
![HireMate Screenshot](screenshots/search.jpeg)

### Activity page
![HireMate Screenshot](screenshots/activity.jpeg)

### Job seeker posts page
![HireMate Screenshot](screenshots/edit-jobseeker-post.jpeg)

### Community page
![HireMate Screenshot](screenshots/community.jpeg)

### Settings page
![HireMate Screenshot](screenshots/settings.jpeg)

### Profile page
![HireMate Screenshot](screenshots/profile.png)


## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Ilyass-Bezaiz/HireMate.git
   cd HireMate
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Set up your environment:
   - Copy `.env.example` to `.env` and configure your database and other settings.
   ```bash
   php artisan key:generate
   ```
4. Run migrations:
   ```bash
   php artisan migrate
   ```
5. Serve the application:
   ```bash
   php artisan serve
   npm run dev
   ```

## Usage

- **Job Seeker**: Create a profile, search for jobs, apply, and track the status of your applications.
- **Employer**: Post job listings and manage applications.
- **Community**: Engage with other users by posting and commenting on job-related topics.

## Support

For any issues or support, please open an issue on [GitHub](https://github.com/Ilyass-Bezaiz/HireMate/issues).

## Roadmap

- Implement advanced filtering options for job search.
- Add an analytics dashboard for employers.
- Introduce a messaging feature for job seekers and employers.

## Contributing

Contributions are welcome! Please follow these steps:
1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch-name`.
3. Make your changes.
4. Commit your changes: `git commit -m 'Add some feature'`.
5. Push to the branch: `git push origin feature-branch-name`.
6. Open a pull request.

## Authors and Acknowledgment

- **Ilyass BEZAIZ**
- **Jawad ElHajjami**
- **Ibrahim BENSAADOUNE**
- **Yahia CHERRAT**


## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

<!-- ## Project Status

The project is actively maintained. Future updates and improvements are planned. -->
