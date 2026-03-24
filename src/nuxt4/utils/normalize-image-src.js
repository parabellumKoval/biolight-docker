export const normalizeImageSrc = (raw) => {
  if (typeof raw !== 'string') return ''

  const value = raw.trim()
  if (!value || value.startsWith('data:')) return value

  if (/^https?:\/\//.test(value)) {
    try {
      const url = new URL(value)

      if (url.pathname.startsWith('/uploads/')) {
        return `${url.pathname}${url.search}${url.hash}`
      }

      return value
    } catch {
      return value
    }
  }

  if (value.startsWith('uploads/')) return `/${value}`
  return value
}
