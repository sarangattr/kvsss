/*

Give the service worker access to Firebase Messaging.

Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.

*/

importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');

importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

   

/*

Initialize the Firebase app in the service worker by passing in the messagingSenderId.

* New configuration for app@pulseservice.com

*/

firebase.initializeApp({

    apiKey: "AIzaSyBMSZ_pLpkDNcaFY61_Ob9JNMqUMN3sq0Y",
    authDomain: "hrmsfcm-defe8.firebaseapp.com",
    projectId: "hrmsfcm-defe8",
    storageBucket: "hrmsfcm-defe8.appspot.com",
    messagingSenderId: "981886989147",
    appId: "1:981886989147:web:58830c402124e9a645e07e",
    measurementId: "G-1B7RHS6V10"

    });

  

/*

Retrieve an instance of Firebase Messaging so that it can handle background messages.

*/

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {

    console.log(

        "[firebase-messaging-sw.js] Received background message ",

        payload,

    );

    /* Customize notification here */

    const notificationTitle = "Background Message Title";

    const notificationOptions = {

        body: "Background Message body.",

        icon: "/itwonders-web-logo.png",

    };

  

    return self.registration.showNotification(

        notificationTitle,

        notificationOptions,

    );

});