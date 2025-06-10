# fakeStore

A fake store used with `storeFakeApi`.
Add laravel db to create a new local store
Use `git clone` to copy this repository to your local machine
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
```

## Laravel config

To install and use Laravel in this project, follow these steps:

### 1. Install dependencies

```bash
cd catalogo-laravel
composer install
```

### 2. Copy the environment file and generate the app key

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure your database

Edit the `.env` file and set your database connection variables:

```
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### 4. Run migrations and seeders

```bash
php artisan migrate --seed
```

### 5. Start the development server

```bash
php artisan serve
```

The Laravel backend will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Firebase config

To use Firebase Storage for uploading and displaying images in your app, follow these steps:

### 1. Create a Firebase project

- Go to [https://console.firebase.google.com/](https://console.firebase.google.com/) and create a new project.
- Enable the **Storage** service.

### 2. Add Firebase configuration to your project

Include the following scripts in your HTML **before your custom script**:

```html
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-storage-compat.js"></script>
```

Then, configure Firebase in your `firebase.js` file:

```js
// Firebase configuration
const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
  projectId: "YOUR_PROJECT_ID",
  storageBucket: "YOUR_PROJECT_ID.appspot.com",
  messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
  appId: "YOUR_APP_ID"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const storage = firebase.storage();
```

### 3. Security rules for development

In the Firebase console, go to **Storage > Rules** and use the following for testing:

```
service firebase.storage {
  match /b/{bucket}/o {
    match /{allPaths=**} {
      allow read, write: if true;
    }
  }
}
```
> **Note:** Do not use these rules in production.

### 4. Upload an image from a form

Example JS code to upload an image:

```js
const form = document.getElementById('upload-image-test');
const input = document.getElementById('image-input');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  const file = input.files[0];
  if (!file) {
    alert('Please select an image');
    return;
  }
  try {
    const storageRef = storage.ref(`imagenes/${file.name}`);
    await storageRef.put(file);
    const url = await storageRef.getDownloadURL();
    alert('Image uploaded successfully. URL: ' + url);
    // You can save this URL in your Laravel database
  } catch (error) {
    alert('Error uploading the image');
    console.error(error);
  }
});
```

---

With this, you can integrate Firebase Storage to upload and display images in your application.
