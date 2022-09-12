import axios from "axios"
import { ref } from "vue"

export default function useAdminPosts() {
    const post = ref([])
    const posts = ref([])

    const fetchPost = async (uuid) => {
        const response = await axios.get(`/admin/posts/${uuid}/edit`)
        post.value = response.data.data
    }

    const fetchPosts = async () => {
        const response = await axios.get('/admin/posts')
        posts.value = response.data.data
    }

    const createPost = async () => {
        const response = await axios.post('/admin/posts')
        return response.data.data
    }

    const patchPost = async (uuid) => {
        await axios.patch(`/admin/posts/${uuid}`, post.value)
    }

    const destroyPost = async (uuid) => {
        await axios.delete(`/admin/posts/${uuid}`)
    }

    return {
        post,
        posts,
        fetchPost,
        fetchPosts,
        createPost,
        patchPost,
        destroyPost
    }
}