import axios from "axios"
import { ref } from "vue"

export default function usePosts() {
    const posts = ref([])
    const post = ref([])

    const fetchPosts = async () => {
        const response = await axios.get('/posts')
        posts.value = response.data.data
    }

    const fetchPost = async (slug) => {
        const response = axios.get(`/post/${slug}`)
        post.value = response.data.data
    }

    return {
        posts,
        post,
        fetchPosts,
        fetchPost
    }
}