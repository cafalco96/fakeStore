//Agregar firebase
// import { initializeApp } from 'firebase/app';
// import { getStorage } from "firebase/storage";
// import { ref, uploadBytes, getDownloadURL } from "firebase/storage";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Configuración de Firebase
const firebaseConfig = {
  apiKey: "AIzaSyBs8fq7UmD_cm8lFEavXlORA3vHNuvJUpk",
  authDomain: "store-3ab01.firebaseapp.com",
  projectId: "store-3ab01",
  storageBucket: "store-3ab01.firebasestorage.app", // Como estaba originalmente
  messagingSenderId: "313529487997",
  appId: "1:313529487997:web:26d8c761c38989b8d79714"
};

// Inicializa Firebase
firebase.initializeApp(firebaseConfig);
const storage = firebase.storage();

const form = document.getElementById('upload-image-test');
const input = document.getElementById('image-input');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  const file = input.files[0];
  if (!file) {
    alert('Selecciona una imagen');
    return;
  }
  try {
    const storageRef = storage.ref(`imagenes/${file.name}`);
    await storageRef.put(file);
    const url = await storageRef.getDownloadURL();
    alert('Imagen subida correctamente. URL: ' + url);
  } catch (error) {
    alert('Error al subir la imagen');
    console.error(error);
  }
});