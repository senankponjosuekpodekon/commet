import { APIService } from '@/services/api'
import { defineStore } from 'pinia'
import { UseToaster } from './toaster'
import router from '@/router'

export const useStore = defineStore('store', {
  state: () => ({
    feed: [],
    trending: [],
    notifications: [],
    showCreatePanel: false,
    showUpdatePanel: false,
    selectedPost: null,
    currentComments: [],
    userData: JSON.parse(localStorage.getItem("userData"))
  }),
  getters: {
    getUser(){
      return this.userData.user
    },
    getUserId(){
      return this.userData.user.id
    }
  },
  actions: {
    switchCreatePanel(value){
      this.showCreatePanel = value;
      if (this.showCreatePanel) {
        document.body.style.overflow = "hidden"
      }
      else{
        document.body.style.overflow = "auto"
      }
    },
    setSelectedPost(post){
      this.selectedPost = post
    },
    setUserData(){
      this.userData = JSON.parse(localStorage.getItem("userData"))
    },
    switchUpdatePanel(value){
      this.showUpdatePanel = value;
      if (this.showUpdatePanel) {
        document.body.style.overflow = "hidden"
      }
      else{
        document.body.style.overflow = "auto"
      }
    },
    getFeed() {
      let request = APIService.fetchAllPosts()
      return request
        .then((response) => {
          this.feed = Object.values(response.data)[0].reverse()
          return true
        })
        .catch(() => {
          const toaster = UseToaster()
          toaster.triggerToast('Error getting data. Please check your internet connection.')
        })
    },
    getTrendingPosts() {
      let request = APIService.fetchTrendingPosts()
      return request
        .then((response) => {
          this.trending = Object.values(response.data)[0]
          return true
        })
        .catch(() => {
          const toaster = UseToaster()
          toaster.triggerToast('Error getting data. Please check your internet connection.')
        })
    },
    createPost(userId, post){
      let request = APIService.postNewPost(userId, post);
      return request
        .then((response) => {
          this.getFeed()
          this.getTrendingPosts()
          return {ok: true};
        })
        .catch((axiosError) => {
          if (axiosError.response) {
            if ((axiosError.response.status === 422)) {
              return {ok: false, errors: axiosError.response.data.errors}
            }
          }
          return {ok: false, message: "Error creating post. Please check your internet connexion"}
        })
    },
    getPost(userId, postId){
      let request = APIService.fetchPost(userId, postId)
      return request
        .then((response) => {
          this.selectedPost = response.data.data
          return {ok: true}
        })
        .catch(() => {
          return {ok: false, message: 'Error getting post. Please check your internet connection'}
        })
    },
    savePost(userId, post, postId){
      let request = APIService.updatePost(userId, post, postId);
      return request
        .then((response) => {
          this.getFeed()
          this.getTrendingPosts()
          this.selectedPost = response.data.data
          return {ok: true};
        })
        .catch((axiosError) => {
          if (axiosError.response) {
            if ((axiosError.response.status === 422)) {
              return {ok: false, errors: axiosError.response.data.errors}
            }
          }
          return {ok: false, message: "Error updating post. Please check your internet connexion"}
        })
    },
    deletePost(userId, postId){
      let request = APIService.deletePost(userId, postId)
      return request
        .then((response) => {
          this.getFeed()
          this.getTrendingPosts()
          return {ok: true}
        })
        .catch(() => {
          return {ok: false, message: "Error deleting post. Please check your internet connexion"}
        })
    },
    commentPost(postId, comment){
      let request = APIService.commentPost(postId, comment)
      return request
        .then(() => {
          this.getPostComments()
          return {ok: true}
        })
        .catch(() => {
          return {ok: false, message: 'Error commenting post'}
        })
    },
    getPostComments(){
      let request = APIService.fetchPostComments()
      return request
        .then((response) => {
          this.currentComments = response.data
          return {ok: true}
        })
        .catch(() => {
          return {ok:false, message: 'Error getting comments. Please check your internet connection'}
        })
    },
    replyToComment(commentId, answer){
      let request = APIService.commentComment(commentId, answer)
      return request
        .then(() => {
          this.getPostComments()
          return {ok: true}
        })
        .catch(() => {
          return {ok: false, message: 'Error commenting post'}
        })
    }
  }
})
