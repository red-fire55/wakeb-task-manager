// vite.config.ts
import { defineConfig } from "file:///D:/github/task_traker/wakeb-task-manager/packages/admin/node_modules/vite/dist/node/index.js";
import { resolve } from "path";
import vue from "file:///D:/github/task_traker/wakeb-task-manager/packages/admin/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import vueJsx from "file:///D:/github/task_traker/wakeb-task-manager/packages/admin/node_modules/@vitejs/plugin-vue-jsx/dist/index.mjs";
var __vite_injected_original_dirname = "D:\\github\\task_traker\\wakeb-task-manager\\packages\\admin";
var config = {
  root: "resources",
  server: {
    port: 5173
  },
  plugins: [
    vue(),
    vueJsx()
    // eslintPlugin({
    //   failOnWarning: false
    // })
  ],
  resolve: {
    alias: {
      "@": resolve(__vite_injected_original_dirname, "resources/js"),
      Component: resolve(__vite_injected_original_dirname, "resources/js/components"),
      spack: resolve(__vite_injected_original_dirname, "resources/js/spack"),
      Store: resolve(__vite_injected_original_dirname, "resources/js/stores"),
      thetheme: resolve(__vite_injected_original_dirname, "resources/js/thetheme"),
      Use: resolve(__vite_injected_original_dirname, "resources/js/composables"),
      View: resolve(__vite_injected_original_dirname, "resources/js/views")
    }
  },
  build: {
    chunkSizeWarningLimit: 800,
    manifest: true,
    emptyOutDir: true,
    outDir: "../../../public/vendor/admin",
    rollupOptions: {
      input: resolve(__vite_injected_original_dirname, "resources/js/main.ts")
    }
  }
};
var configProduction = {
  esbuild: {
    drop: ["console", "debugger"]
  }
};
var vite_config_default = defineConfig(({ command }) => {
  if (command === "build") {
    return Object.assign(config, configProduction);
  }
  return config;
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcudHMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJEOlxcXFxnaXRodWJcXFxcdGFza190cmFrZXJcXFxcd2FrZWItdGFzay1tYW5hZ2VyXFxcXHBhY2thZ2VzXFxcXGFkbWluXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJEOlxcXFxnaXRodWJcXFxcdGFza190cmFrZXJcXFxcd2FrZWItdGFzay1tYW5hZ2VyXFxcXHBhY2thZ2VzXFxcXGFkbWluXFxcXHZpdGUuY29uZmlnLnRzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9EOi9naXRodWIvdGFza190cmFrZXIvd2FrZWItdGFzay1tYW5hZ2VyL3BhY2thZ2VzL2FkbWluL3ZpdGUuY29uZmlnLnRzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSdcclxuaW1wb3J0IHsgcmVzb2x2ZSB9IGZyb20gJ3BhdGgnXHJcbmltcG9ydCBlc2xpbnRQbHVnaW4gZnJvbSAndml0ZS1wbHVnaW4tZXNsaW50J1xyXG5pbXBvcnQgdnVlIGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZSdcclxuaW1wb3J0IHZ1ZUpzeCBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUtanN4J1xyXG5cclxuY29uc3QgY29uZmlnID0ge1xyXG4gIHJvb3Q6ICdyZXNvdXJjZXMnLFxyXG4gIHNlcnZlcjoge1xyXG4gICAgcG9ydDogNTE3M1xyXG4gIH0sXHJcbiAgcGx1Z2luczogW1xyXG4gICAgdnVlKCksXHJcbiAgICB2dWVKc3goKSxcclxuICAgIC8vIGVzbGludFBsdWdpbih7XHJcbiAgICAvLyAgIGZhaWxPbldhcm5pbmc6IGZhbHNlXHJcbiAgICAvLyB9KVxyXG4gIF0sXHJcbiAgcmVzb2x2ZToge1xyXG4gICAgYWxpYXM6IHtcclxuICAgICAgJ0AnOiByZXNvbHZlKF9fZGlybmFtZSwgJ3Jlc291cmNlcy9qcycpLFxyXG4gICAgICBDb21wb25lbnQ6IHJlc29sdmUoX19kaXJuYW1lLCAncmVzb3VyY2VzL2pzL2NvbXBvbmVudHMnKSxcclxuICAgICAgc3BhY2s6IHJlc29sdmUoX19kaXJuYW1lLCAncmVzb3VyY2VzL2pzL3NwYWNrJyksXHJcbiAgICAgIFN0b3JlOiByZXNvbHZlKF9fZGlybmFtZSwgJ3Jlc291cmNlcy9qcy9zdG9yZXMnKSxcclxuICAgICAgdGhldGhlbWU6IHJlc29sdmUoX19kaXJuYW1lLCAncmVzb3VyY2VzL2pzL3RoZXRoZW1lJyksXHJcbiAgICAgIFVzZTogcmVzb2x2ZShfX2Rpcm5hbWUsICdyZXNvdXJjZXMvanMvY29tcG9zYWJsZXMnKSxcclxuICAgICAgVmlldzogcmVzb2x2ZShfX2Rpcm5hbWUsICdyZXNvdXJjZXMvanMvdmlld3MnKVxyXG4gICAgfSxcclxuICB9LFxyXG4gIGJ1aWxkOiB7XHJcbiAgICBjaHVua1NpemVXYXJuaW5nTGltaXQ6IDgwMCxcclxuICAgIG1hbmlmZXN0OiB0cnVlLFxyXG4gICAgZW1wdHlPdXREaXI6IHRydWUsXHJcbiAgICBvdXREaXI6ICcuLi8uLi8uLi9wdWJsaWMvdmVuZG9yL2FkbWluJyxcclxuICAgIHJvbGx1cE9wdGlvbnM6IHtcclxuICAgICAgaW5wdXQ6IHJlc29sdmUoX19kaXJuYW1lLCAncmVzb3VyY2VzL2pzL21haW4udHMnKSxcclxuICAgIH0sXHJcbiAgfSxcclxufVxyXG5cclxuY29uc3QgY29uZmlnUHJvZHVjdGlvbiA9IHtcclxuICBlc2J1aWxkOiB7XHJcbiAgICBkcm9wOiBbJ2NvbnNvbGUnLCAnZGVidWdnZXInXSxcclxuICB9LFxyXG59XHJcblxyXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoKHsgY29tbWFuZCB9KSA9PiB7XHJcbiAgaWYgKGNvbW1hbmQgPT09ICdidWlsZCcpIHtcclxuICAgIHJldHVybiBPYmplY3QuYXNzaWduKGNvbmZpZywgY29uZmlnUHJvZHVjdGlvbilcclxuICB9XHJcblxyXG4gIHJldHVybiBjb25maWdcclxufSlcclxuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFtVyxTQUFTLG9CQUFvQjtBQUNoWSxTQUFTLGVBQWU7QUFFeEIsT0FBTyxTQUFTO0FBQ2hCLE9BQU8sWUFBWTtBQUpuQixJQUFNLG1DQUFtQztBQU16QyxJQUFNLFNBQVM7QUFBQSxFQUNiLE1BQU07QUFBQSxFQUNOLFFBQVE7QUFBQSxJQUNOLE1BQU07QUFBQSxFQUNSO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDUCxJQUFJO0FBQUEsSUFDSixPQUFPO0FBQUE7QUFBQTtBQUFBO0FBQUEsRUFJVDtBQUFBLEVBQ0EsU0FBUztBQUFBLElBQ1AsT0FBTztBQUFBLE1BQ0wsS0FBSyxRQUFRLGtDQUFXLGNBQWM7QUFBQSxNQUN0QyxXQUFXLFFBQVEsa0NBQVcseUJBQXlCO0FBQUEsTUFDdkQsT0FBTyxRQUFRLGtDQUFXLG9CQUFvQjtBQUFBLE1BQzlDLE9BQU8sUUFBUSxrQ0FBVyxxQkFBcUI7QUFBQSxNQUMvQyxVQUFVLFFBQVEsa0NBQVcsdUJBQXVCO0FBQUEsTUFDcEQsS0FBSyxRQUFRLGtDQUFXLDBCQUEwQjtBQUFBLE1BQ2xELE1BQU0sUUFBUSxrQ0FBVyxvQkFBb0I7QUFBQSxJQUMvQztBQUFBLEVBQ0Y7QUFBQSxFQUNBLE9BQU87QUFBQSxJQUNMLHVCQUF1QjtBQUFBLElBQ3ZCLFVBQVU7QUFBQSxJQUNWLGFBQWE7QUFBQSxJQUNiLFFBQVE7QUFBQSxJQUNSLGVBQWU7QUFBQSxNQUNiLE9BQU8sUUFBUSxrQ0FBVyxzQkFBc0I7QUFBQSxJQUNsRDtBQUFBLEVBQ0Y7QUFDRjtBQUVBLElBQU0sbUJBQW1CO0FBQUEsRUFDdkIsU0FBUztBQUFBLElBQ1AsTUFBTSxDQUFDLFdBQVcsVUFBVTtBQUFBLEVBQzlCO0FBQ0Y7QUFFQSxJQUFPLHNCQUFRLGFBQWEsQ0FBQyxFQUFFLFFBQVEsTUFBTTtBQUMzQyxNQUFJLFlBQVksU0FBUztBQUN2QixXQUFPLE9BQU8sT0FBTyxRQUFRLGdCQUFnQjtBQUFBLEVBQy9DO0FBRUEsU0FBTztBQUNULENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
