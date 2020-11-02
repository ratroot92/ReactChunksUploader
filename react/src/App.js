   import React, { Component } from 'react'
import FineUploaderTraditional from 'fine-uploader-wrappers'
import Gallery from 'react-fine-uploader'
 
// ...or load this specific CSS file using a <link> tag in your document
import 'react-fine-uploader/gallery/gallery.css'


const FileList=[];


const uploader = new FineUploaderTraditional({

    
    options: {
    
        callbacks: {
            onAllComplete: function(id,name,response) {
                // console.log("allcomp",name);
                // console.log("allcomp",id);
                // console.log("allcomp",response)
            },
            onComplete: function(id,name,response) {
            //    console.log("comp",name);
            //    console.log("comp",id);
            //    console.log("comp",response)
            //    fetch(`http://127.0.0.1/api/videos/processVideo?fileName=${response['fileName']}`).then((res)=>{
            //        console.log("asd");
            //    }).catch((err)=>{
            //        console.log("ERROR")
            //    })
            },
            onUpload:function(id,name,response) {
                console.log("___",name);
                console.log("___",id);
                console.log("___",response)
                },
                onValidate:function(e){ 
                    let data={
                        filename:e['name'],
                         size:e['size'],
                         randomName:new Date().getTime(),
                    }
                    FileList['filename']={}
                    FileList['filename']=data
                    console.log("***")
                    console.log(FileList)
                    


                    },
           
        },
        chunking: {
          enabled: true,
          concurrent: {
              enabled: true
          },
          success: {
            endpoint: "http://127.0.0.1/api/videos/processVideo"
        }
        },
        // deleteFile: {
        //     enabled: true,
        //     endpoint: '/api/videos/uploadChunks'
        // },
        debug: true,
        request: {
            
            endpoint: `http://127.0.0.1/api/videos/uploadChunks?name=${new Date().getTime()}`,
          
        },
        retry: {
            enableAuto: true
        }
    }
})
const statusTextOverride = {
  upload_successful: 'Success!'
}
class App extends Component {
    render() {
        return (
            <Gallery status-text={ { text: statusTextOverride } } uploader={ uploader } />
        )
    }
}
 
export default App