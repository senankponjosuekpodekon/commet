import { useStore } from '@/stores'
import axios from 'axios'

class API {
  fetchAllPosts() {
    return axios.get('posts/all')
  }

  fetchTrendingPosts() {
    return axios.get('posts/trending')
  }

  fetchPost(userId, postId){
    return axios.get('/users/' + userId + '/posts/' + postId)
  }

  postNewPost(userId, post){
    const postInfo = {
      title: post.title,
      link: post.link,
      content: post.content
    }

    return axios.post('/users/' + userId + '/posts', postInfo)
  }

  updatePost(userId, post, postId){
    const postInfo = {
      title: post.title,
      link: post.link,
      content: post.content
    }

    return axios.put('/users/' + userId + '/posts/' + postId, postInfo)
  }

  deletePost(userId, postId){
    return axios.delete('/users/' + userId + '/posts/' + postId)
  }

  commentPost(postId, commentInfo){
    const comment = {
      content: commentInfo
    }
    return axios.post('/posts/' + postId + '/comments', comment)
  }

  fetchPostComments(){
    const store = useStore()
    return axios.get('posts/' + store.selectedPost.id + '/comments')
  }

  commentComment(parentId, answer){
    const comment = {
      content: answer,
      parent_id: parentId
    }
    const store = useStore()
    return axios.post('posts/' + store.selectedPost.id + '/comments', comment)
  }
}

export const APIService = new API()
