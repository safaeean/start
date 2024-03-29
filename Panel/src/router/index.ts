import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'

import AuthLayout from '../layouts/AuthLayout.vue'
import AppLayout from '../layouts/AppLayout.vue'
import Page404Layout from '../layouts/Page404Layout.vue'

import RouteViewComponent from '../layouts/RouterBypass.vue'
import UIRoute from '../pages/admin/ui/route'

import Users from "../pages/admin/users/Users.vue";
import EditUser from "../pages/admin/users/EditUser.vue";

import Posts from "../pages/admin/blog/posts/Posts.vue";
import EditPost from "../pages/admin/blog/posts/EditPost.vue";
import CreatePost from "../pages/admin/blog/posts/CreatePost.vue";

import Categories from "../pages/admin/blog/categories/Categories.vue";
import EditCategory from "../pages/admin/blog/categories/EditCategory.vue";
import CreateCategory from "../pages/admin/blog/categories/CreateCategory.vue";
import Setting from "../pages/admin/settings/Setting.vue";

import Roles from "../pages/admin/role/Roles.vue";
import EditRole from "../pages/admin/role/EditRole.vue";
import CreateRole from "../pages/admin/role/CreateRole.vue";

import Permissions from "../pages/admin/permission/Permissions.vue";
import EditPermission from "../pages/admin/permission/EditPermission.vue";
import CreatePermission from "../pages/admin/permission/CreatePermission.vue";

import Pages from "../pages/admin/page/Pages.vue";
import EditPage from "../pages/admin/page/EditPage.vue";
import CreatePage from "../pages/admin/page/CreatePage.vue";

const routes: Array<RouteRecordRaw> = [
  {
    path: '/:catchAll(.*)',
    redirect: { name: 'dashboard' },
  },
  {
    name: 'admin',
    path: '/admin',
    component: AppLayout,
    children: [
      {
        name: 'dashboard',
        path: 'dashboard',
        component: () => import('../pages/admin/dashboard/Dashboard.vue'),
      },
      {
        name: 'user',
        path: 'user',
        component: RouteViewComponent,
        children: [
          {
            name: 'users',
            path: 'users',
            component: Users,
          },
          {
            name: 'user-edit',
            path: 'edit/:user',
            component: EditUser,
          },
          {
            name: 'user-edit',
            path: 'edit/:user',
            component: EditUser,
          },
        ],
      },
      {
        name: 'role',
        path: 'role',
        component: RouteViewComponent,
        children: [
          {
            name: 'roles',
            path: 'roles',
            component: Roles,
          },
          {
            name: 'role-edit',
            path: 'edit/:role',
            component: EditRole,
          },
          {
            name: 'role-create',
            path: 'create',
            component: CreateRole,
          },
        ],
      },
      {
        name: 'permission',
        path: 'permission',
        component: RouteViewComponent,
        children: [
          {
            name: 'permissions',
            path: 'permissions',
            component: Permissions,
          },
          {
            name: 'permission-edit',
            path: 'edit/:permission',
            component: EditPermission,
          },
          {
            name: 'permission-create',
            path: 'create',
            component: CreatePermission,
          },
        ],
      },
      {
        name: 'page',
        path: 'page',
        component: RouteViewComponent,
        children: [
          {
            name: 'pages',
            path: 'pages',
            component: Pages,
          },
          {
            name: 'page-edit',
            path: 'edit/:page',
            component: EditPage,
          },
          {
            name: 'page-create',
            path: 'create',
            component: CreatePage,
          },
        ],
      },
      {
        name: 'blog',
        path: 'blog',
        component: RouteViewComponent,
        children: [
          {
            name: 'post',
            path: 'post',
            component: RouteViewComponent,
            children: [
              {
                name: 'posts',
                path: 'posts',
                component: Posts,
              },
              {
                name: 'post-edit',
                path: 'edit/:post',
                component: EditPost,
              },
              {
                name: 'post-create',
                path: 'create',
                component: CreatePost,
              },
            ]
          },
          {
            name: 'category',
            path: 'category',
            component: RouteViewComponent,
            children: [
              {
                name: 'categories',
                path: 'categories',
                component: Categories,
              },
              {
                name: 'category-edit',
                path: 'edit/:category',
                component: EditCategory,
              },
              {
                name: 'category-create',
                path: 'create',
                component: CreateCategory,
              },
            ]
          }
        ],
      },
      {
        name: 'setting',
        path: 'setting',
        component: Setting,
      },
      {
        name: 'statistics',
        path: 'statistics',
        component: RouteViewComponent,
        children: [
          {
            name: 'charts',
            path: 'charts',
            component: () => import('../pages/admin/statistics/charts/Charts.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Charts',
            },
          },
          {
            name: 'progress-bars',
            path: 'progress-bars',
            component: () => import('../pages/admin/statistics/progress-bars/ProgressBars.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Progress-Bars',
            },
          },
        ],
      },
      {
        name: 'forms',
        path: 'forms',
        component: RouteViewComponent,
        children: [
          {
            name: 'form-elements',
            path: 'form-elements',
            component: () => import('../pages/admin/forms/form-elements/FormElements.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/inputs',
            },
          },
          {
            name: 'medium-editor',
            path: 'medium-editor',
            component: () => import('../pages/admin/forms/medium-editor/MediumEditor.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Medium-Editor',
            },
          },
        ],
      },
      {
        name: 'maps',
        path: 'maps',
        component: RouteViewComponent,
        children: [
          {
            name: 'maplibre-maps',
            path: 'maplibre-maps',
            component: () => import('../pages/admin/maps/maplibre-maps/MapLibreMapsPage.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Maps',
            },
          },
          {
            name: 'yandex-maps',
            path: 'yandex-maps',
            component: () => import('../pages/admin/maps/yandex-maps/YandexMapsPage.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Maps',
            },
          },
          {
            name: 'leaflet-maps',
            path: 'leaflet-maps',
            component: () => import('../pages/admin/maps/leaflet-maps/LeafletMapsPage.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Maps',
            },
          },
          {
            name: 'bubble-maps',
            path: 'bubble-maps',
            component: () => import('../pages/admin/maps/bubble-maps/BubbleMapsPage.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Maps',
            },
          },
          {
            name: 'line-maps',
            path: 'line-maps',
            component: () => import('../pages/admin/maps/line-maps/LineMapsPage.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Maps',
            },
          },
        ],
      },
      {
        name: 'tables',
        path: 'tables',
        component: RouteViewComponent,
        children: [
          {
            name: 'markup',
            path: 'markup',
            component: () => import('../pages/admin/tables/markup-tables/MarkupTables.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Tables',
            },
          },
          {
            name: 'data',
            path: 'data',
            component: () => import('../pages/admin/tables/data-tables/DataTables.vue'),
            meta: {
              wikiLink: 'https://github.com/epicmaxco/vuestic-admin/wiki/Tables',
            },
          },
        ],
      },
      {
        name: 'extra-pages',
        path: 'extra-pages',
        component: RouteViewComponent,
        children: [
          {
            name: '404-pages',
            path: '404-pages',
            component: () => import('../pages/admin/pages/404PagesPage.vue'),
          },
          {
            name: 'faq',
            path: 'faq',
            component: () => import('../pages/admin/pages/FaqPage.vue'),
          },
        ],
      },
      UIRoute,
    ],
  },
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      {
        name: 'login',
        path: 'login',
        component: () => import('../pages/auth/login/Login.vue'),
      },
      {
        name: 'signup',
        path: 'signup',
        component: () => import('../pages/auth/signup/Signup.vue'),
      },
      {
        name: 'recover-password',
        path: 'recover-password',
        component: () => import('../pages/auth/recover-password/RecoverPassword.vue'),
      },
      {
        path: '',
        redirect: { name: 'login' },
      },
    ],
  },
  {
    path: '/404',
    component: Page404Layout,
    children: [
      {
        name: 'not-found-advanced',
        path: 'not-found-advanced',
        component: () => import('../pages/404-pages/VaPageNotFoundSearch.vue'),
      },
      {
        name: 'not-found-simple',
        path: 'not-found-simple',
        component: () => import('../pages/404-pages/VaPageNotFoundSimple.vue'),
      },
      {
        name: 'not-found-custom',
        path: 'not-found-custom',
        component: () => import('../pages/404-pages/VaPageNotFoundCustom.vue'),
      },
      {
        name: 'not-found-large-text',
        path: '/pages/not-found-large-text',
        component: () => import('../pages/404-pages/VaPageNotFoundLargeText.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  //  mode: process.env.VUE_APP_ROUTER_MODE_HISTORY === 'true' ? 'history' : 'hash',
  routes,
})

export default router
