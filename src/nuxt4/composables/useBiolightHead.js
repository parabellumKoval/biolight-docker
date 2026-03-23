import { unref } from 'vue'

export const useBiolightHead = ({ title, description, scripts = {} } = {}) => {
  useHead(() => ({
    title: unref(title) || '',
    meta: [
      ...(unref(description)
        ? [
            {
              name: 'description',
              content: unref(description)
            }
          ]
        : []),
      ...(scripts.meta || [])
    ],
    script: scripts.script || []
  }))
}
