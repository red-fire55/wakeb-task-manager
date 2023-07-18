import { appData } from '@/app-data'
import axiosCore from 'axios'
import type { AxiosInstance, AxiosResponse } from 'axios'
import { router } from '@/router'

const axios: AxiosInstance = axiosCore.create({
  baseURL: appData.prefix ? `/${appData.prefix}/api/` : '/api/',
})

axios.interceptors.response.use(
  (data: AxiosResponse) => data,
  (error) => {
    const { status } = error.response

    switch (status) {
      case 401:
        window.location.href = '/login'
        break

      case 403:
        router.push('/403')
        break

      case 404:
        break

      case 419:
        location.reload()
        break

      case 500:
        break

      default:
    }

    return Promise.reject(error)
  },
)

export { axios }
