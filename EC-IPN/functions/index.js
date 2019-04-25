class PayPalService {

  static validate(body = {}) {
    return new Promise((resolve, reject) => {
      // Prepend 'cmd=_notify-validate' flag to the post string
      let postreq = 'cmd=_notify-validate';
      
      // Iterate the original request payload object
      // and prepend its keys and values to the post string
      Object.keys(body).map((key) => {
        postreq = `${postreq}&${key}=${body[key]}`;
        return key;
      });

      const options = {
        url: 'https://ipnpb.paypal.com/cgi-bin/webscr',
        method: 'POST',
        headers: {
          'Content-Length': postreq.length,
        },
        encoding: 'utf-8',
        body: postreq
      };

      // Make a post request to PayPal
      request(options, (error, response, resBody) => {
        if (error || response.statusCode !== 200) {
          reject(new Error(error));
          return;
        }

        // Validate the response from PayPal and resolve / reject the promise.
        if (resBody.substring(0, 8) === 'VERIFIED') {
          resolve(true);
        } else if (resBody.substring(0, 7) === 'INVALID') {
          reject(new Error('IPN Message is invalid.'));
        } else {
          reject(new Error('Unexpected response body.'));
        }
      });
    });
  }

}

// cmd
// ec2-user:~/environment/EC-IPN (master) $ firebase deploy --only functions


//get Link
//https://us-central1-ipn-ec-jj.cloudfunctions.net/addMessage?text=aquiVaiOseuTexto
//https://us-central1-ipn-ec-jj.cloudfunctions.net/addMessagePost
//https://us-central1-ipn-ec-jj.cloudfunctions.net/ipn


const functions = require('firebase-functions');

// // Create and Deploy Your First Cloud Functions
// // https://firebase.google.com/docs/functions/write-firebase-functions
//
// exports.helloWorld = functions.https.onRequest((request, response) => {
//  response.send("Hello from Firebase!");
// });


// // The Cloud Functions for Firebase SDK to create Cloud Functions and setup triggers.
// const functions = require('firebase-functions');

// The Firebase Admin SDK to access the Firebase Realtime Database.
const admin = require('firebase-admin');
admin.initializeApp();

/*
##################### MyFunctions #####################
*/

//My testing functions 

// Take the text parameter passed to this HTTP endpoint and insert it into the
// Realtime Database under the path /messages/:pushId/original
exports.addMessage = functions.https.onRequest((req, res) => {
  // Grab the text parameter.
  const original = req.query.text;
  // Push the new message into the Realtime Database using the Firebase Admin SDK.
  return admin.database().ref('/messages').push({original: original}).then((snapshot) => {
    // Redirect with 303 SEE OTHER to the URL of the pushed object in the Firebase console.
    return res.redirect(303, snapshot.ref.toString());
  });
});

exports.addMessagePost = functions.https.onRequest((req, res) => {
  // Grab the text parameter.
  const original = req.body.first_name;
  // Push the new message into the Realtime Database using the Firebase Admin SDK.
  return admin.database().ref('/messages').push({original: original}).then((snapshot) => {
    // Redirect with 303 SEE OTHER to the URL of the pushed object in the Firebase console.
    return res.redirect(303, snapshot.ref.toString());
  });
});

exports.ipn = functions.https.onRequest(()=>{
      try {
        
      const isValidated = PayPalService.validate(body);
      if (!isValidated) {
        console.error('Error validating IPN message.');
        return;
      }
      
      // IPN Message is validated!
      const transactionType = body.txn_type;
      
      switch (transactionType) {
        case 'web_accept':
        case 'subscr_payment':
          const status = body.payment_status;
          const amount = body.mc_gross;
          // Validate that the status is completed, 
          // and the amount match your expectaions.
          break;
        case 'subscr_signup':
        case 'subscr_cancel':
        case 'subscr_eot':
          // Update user profile
          break;
        case 'recurring_payment_suspended':
        case 'recurring_payment_suspended_due_to_max_failed_payment':  
          // Contact the user for more details
          break;
        default:
          console.log('Unhandled transaction type: ', transactionType);
      }
    } catch(e) {
      console.error(e); 
    }

})





