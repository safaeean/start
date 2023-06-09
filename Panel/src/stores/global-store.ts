import { defineStore } from 'pinia'
import axios from 'axios'

export const useGlobalStore = defineStore('global', {
  state: () => {
    return {
      isSidebarMinimized: false,
      user: {},
    }
  },

  actions: {
    toggleSidebar() {
      this.isSidebarMinimized = !this.isSidebarMinimized
    },
    async setUser() {
      this.user = await axios
        .get('/api/api/user')
        .then(function (response) {
          if(!response.data.is_admin){
            window.location.replace('/')
            return;
          }
          return response.data
        })
        .catch(function () {
          window.location.replace('/auth/login')
        })
    },
  },
})
