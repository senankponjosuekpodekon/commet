## Outline \- Documentation

1\. Introduction

2\. Installation

3\. Usage

4\. Development

5\. Deployment

6\. Bug Tracking
7\. Contribution

8\. License

# COMMET Documentation

# Introduction

YOWL is a web application that allows users to comment on any content found on the Internet and share that feedback with the YOWL community. This documentation covers installation, usage, development, deployment, bug tracking, and contribution.

# Installation

# Prerequisites

\- Docker

\- Docker Compose

# Installation Steps

**1\. Clone the repository:**
\`\`\`bash
git clone git@github.com:EpitechCodingAcademyPromo2024/C-DEV-160-COT-1-2-yowl-melvyn.quenum.git
cd app
\`\`\`

**2\. Build and start the Docker containers:**
\`\`\`bash
docker-compose up \--build
\`\`\`

**3\. Access the application:**
**\- Frontend:** http://localhost:5173
**\- API:** http://localhost:8000

# Usage

# Access the Application

**\- Frontend:** Open your browser and go to http://localhost:5173. **\- API:** Go to http://localhost:8000 to interact with the API.

# Authentication

**1\. Registration:** Create an account via the registration interface.

**2\. Login:** Log in with your credentials to access the application's features.

# Main Features

**\- Commenting**: Add comments on any content found on the Internet.

**\- Sharing:** Share your comments with the COMMET community.

**\- Search:** Search for comments by content, or keywords.

# Development

# Technologies Used

**\- Backend :** Laravel
**\- Frontend :** Vue.js
**\- Database :** MySQL
**\- Containerization :** Docker

# Project Structure

**\- Backend :** \`src/backend\`
**\- Frontend :** \`src/frontend\`
**\- Docker :** \`Dockerfile\`, \`docker-compose.yml\`

# Configurations

**\- Database :** Configure environment variables in \`.env\` to connect your database.
**\- API :** Configure routes and controllers in Laravel.
**\- Frontend :** Configure components and views in Vue.js.

# Development Scripts

**\- Start the Server:**
\`\`\`bash
docker-compose up
\`\`\`
**\- Test the Application:**
\`\`\`bash
php artisan test
npm run test
\`\`\`

# Deployment

# Prerequisites

\- Heroku account or other deployment platform
\- Docker

# Deployment Steps on Heroku

**1\. Log in to Heroku:**
\`\`\`bash
heroku login
\`\`\`

**2\. Create a new Heroku application:**
\`\`\`bash
heroku create app-name
\`\`\`

**3\. Deploy the application:**
\`\`\`bash
git push heroku main
\`\`\`

**4\. Set environment variables:**
\`\`\`bash
heroku config:set APP\_ENV=production
\`\`\`

**5\. Access the deployed application:**
\- https://app-name.herokuapp.com

# Bug Tracking

# Tools Used

**\- GitHub Issues:** Use GitHub issues to report and track bugs.

# Bug Tracking Flow

**1\. Bug Reporting:**

**2\. Bug Fixing:**

**3\. Testing and Validation:**

**4\. Deployment:**

# Contributing

# How to Contribute

**1\. Fork the Repository:** Fork the main repository.
**2\. Clone the Forked Repository:**
\`\`\`bash
git clone git@github.com:EpitechCodingAcademyPromo2024/C-DEV-160-COT-1-2-yowl-melvyn.quenum.git
cd app
\`\`\`
**3\. Create a Branch for your Changes:**
\`\`\`bash
git checkout \-b feature/new-feature
\`\`\`
**4\. Make your Changes and Commit them:**
\`\`\`bash
git commit \-am '\[ADD\]: Adding a new feature'
\`\`\`
**5\. Push the Branch to GitHub:**
\`\`\`bash
git push origin feature/new-feature
\`\`\`
**6\. Create a Pull Request:** Go to GitHub and create a pull request from your branch.

# Guidelines

**\- Code Quality:** Make sure your code is clean and well-documented.

**\- Testing:** Write tests for your new features.

**\- Compliance:** Follow the project's code style conventions.

# License

This project is licensed under the MIT License. See the LICENSE file for more information.

\`\`\`