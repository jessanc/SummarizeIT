'use strict';

const AWS = require('aws-sdk');
const uuid = require('uuid/v4');
const promise = require('promise');

module.exports.hello = async event => {
  return {
    statusCode: 200,
    body: JSON.stringify(
      {
        message: 'Go Serverless v1.0! Your function executed successfully!',
        input: event,
      },
      null,
      2
    ),
  };

  // Use this code if you don't use the http event with the LAMBDA-PROXY integration
  // return { message: 'Go Serverless v1.0! Your function executed successfully!', event };
};

module.exports.uploadAudio = (event, context, callback) => {
  var s3 = new AWS.S3();
  let request = event.body;
  let buffer = Buffer.from(request, 'base64').toString();

  var s3Params = {
    Bucket: 'summarizeitaudios',
    Key:  uuid(),
    Body: buffer,
    ContentType: 'wav',
    ACL: 'public-read',
  };

  var uploadURL;;

  s3.upload(s3Params, function(err, data){
    if(err){
      throw err;
    }
    console.log(`Successfully uploaded at ${data.Location}.`);
    uploadURL = data.Location;

    console.log("calling callback");
    callback(null, {
      statusCode: 200,
      headers: {
        'Access-Control-Allow-Origin': '*' //probably only allow the AWS ec2 instance to access
      },
      body: JSON.stringify({ uploadURL: uploadURL }),
    })
  });
};


