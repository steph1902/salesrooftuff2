<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.8.1/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyC5dcK9NUhfgLy5kmcZLTRm2YO5nFCt9uw",
    authDomain: "rooftuff-d4662.firebaseapp.com",
    projectId: "rooftuff-d4662",
    storageBucket: "rooftuff-d4662.appspot.com",
    messagingSenderId: "1001045786654",
    appId: "1:1001045786654:web:8da55977fdf8b8f0ea6e0f",
    measurementId: "G-YCHJ0D12RC"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>