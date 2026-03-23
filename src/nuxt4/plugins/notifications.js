export default defineNuxtPlugin((nuxtApp) => {
  const notifications = useState('notifications', () => [])
  let counter = 0

  const notify = (payload = {}) => {
    const item = {
      duration: 5000,
      group: 'default',
      id: ++counter,
      text: '',
      title: '',
      type: 'info',
      ...payload
    }

    notifications.value = [...notifications.value, item]

    if (item.duration > 0) {
      setTimeout(() => {
        notifications.value = notifications.value.filter((entry) => entry.id !== item.id)
      }, item.duration)
    }

    return item
  }

  nuxtApp.provide('notify', notify)
})
