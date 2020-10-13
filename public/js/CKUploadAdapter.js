class CkUploadAdapter {
    constructor( loader ) {
        // CKEditor 5's FileLoader instance.
        this.loader = loader;
        // URL where to send files.
        this.url = 'http://local.flipkoti.fi/admin/request/upload_image';
    }

    // Starts the upload process.
    // upload() {
    //     return new Promise( ( resolve, reject ) => {
    //         this._initRequest();
    //         this._initListeners( resolve, reject );
    //         this._sendRequest();
    //     } );
    // }

    // Starts the upload process.
    upload() {
        // return this.loader.file;
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Example implementation using XMLHttpRequest.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();
        
        xhr.open( 'POST', this.url, true );
        xhr.responseType = 'json';
        //xhr.setRequestHeader("Content-Type","multipart/form-data");
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = 'Couldn\'t upload file:' + ` ${ loader.file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            if ( !response || response.error ) {
                return reject( response && response.error ? response.error.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            resolve( {
                default: response.url
            } );
        } );

        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest(file) {
        const data = new FormData();

        data.append( 'image', file );

        this.xhr.send( data );
    }
}