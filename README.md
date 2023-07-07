## Status

[![pipeline status](https://gitlab.com/safaeean/start/badges/master/pipeline.svg)](https://gitlab.com/safaeean/start/-/commits/master)
[![Latest Release](https://gitlab.com/safaeean/start/-/badges/release.svg)](https://gitlab.com/safaeean/start/-/releases)
[![coverage report](https://gitlab.com/safaeean/start/badges/master/coverage.svg)](https://gitlab.com/safaeean/start/-/commits/master)
![example workflow](https://github.com/safaeean/start/actions/workflows/push.yml/badge.svg)



## Minimal Laravel backend + Vue admin panel + Nuxt frontend (Dockerized)

This project is a Dockerized application that combines a minimal Laravel backend, a Vue-based admin panel, and a Nuxt frontend. It provides the essential features and functionality required for managing and presenting data efficiently. The Laravel backend handles server-side logic, while the Vue admin panel enables easy administration and configuration. The Nuxt frontend ensures a seamless user experience with optimized rendering and routing. Together, they form a cohesive system that allows for building web applications with a basic yet effective set of features


### Features
- User authentication and authorization:
   - User registration and login
   - Password reset functionality
   - Email verification for user accounts
   - User management with different roles and permissions
   - Ability to create and modify roles and permissions
- Manage blog posts:
   - Create, edit blog posts
   - Categorize blog posts into different categories

### Admin panel:

Vuestic Admin: https://github.com/epicmaxco/vuestic-admin
### Backend API:

Laravel 10: https://github.com/laravel/laravel
### Frontend template:

Bootstrap/HTML5 Responsive Template: https://github.com/learning-zone/website-templates/tree/master/enlive-corporate-free-html5-bootstrap-web-template
## Usage:

To use this repository, follow the steps below:

1. Fork the repository and clone it to your local machine:

    ```bash
    git clone git@github.com:safaeean/start.git
    ```
    Replace safaeean with your own username.

2. Run the following command to start the project:
    ```bash
    docker-compose up -d
    ```
    If you want to run the project in developer mode, use the following command instead:

    ```bash
    docker-compose -f docker-compose-dev.yml up -d
    ```
These instructions will help you set up and run the project. Feel free to customize it according to your specific needs.

If you need further assistance, feel free to ask!