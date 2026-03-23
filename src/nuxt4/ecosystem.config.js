module.exports = {
  apps: [
    {
      name: 'nuxt-dev',
      script: 'npm',
      args: 'run dev',
      cwd: '/var/www/your-project',
      env: {
        HOST: '0.0.0.0',
        PORT: '3000'
      },
      watch: false
    },
    {
      name: "nuxt-prod",
      script: "./node_modules/nuxt/bin/nuxt.js",
      args: "start",
      instances: "max",
      exec_mode: "cluster"
    },
    /*
        {
          name: "nuxt-dev",
          script: "./node_modules/nuxt/bin/nuxt.js",
          args: "dev",
          instances : "max",
          exec_mode : "cluster"
        },
    */
    /*
        {
          name: "nuxt-prod",
          script: "./node_modules/nuxt/bin/nuxt.js",
          args: "start"
        }
    */
  ]
}