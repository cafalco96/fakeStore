# fakeStore

A fake store used with `storeFakeApi`.

---

## 🗺️ Map Config

To enable Google Maps, follow these steps:

1. Create a file named `config-map.js` in the root of the project.
2. Add the following configuration, replacing `"API_KEY_MAP"` with your actual Google Maps API key:

```js
window.CONFIG = {
  GOOGLE_MAPS_API_KEY: "API_KEY_MAP", // Your Google Maps API key
  DEFAULT_LAT: -0.3301,
  DEFAULT_LNG: -78.4428,
  DEFAULT_ZOOM: 16
};
