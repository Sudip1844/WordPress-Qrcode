const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = 5000;
const STATIC_DIR = path.join(__dirname, 'extracted_site');

// MIME types for common file extensions
const mimeTypes = {
    '.html': 'text/html',
    '.css': 'text/css',
    '.js': 'application/javascript',
    '.json': 'application/json',
    '.png': 'image/png',
    '.jpg': 'image/jpeg',
    '.jpeg': 'image/jpeg',
    '.gif': 'image/gif',
    '.svg': 'image/svg+xml',
    '.ico': 'image/x-icon',
    '.woff': 'font/woff',
    '.woff2': 'font/woff2',
    '.ttf': 'font/ttf',
    '.xml': 'application/xml',
    '.zip': 'application/zip'
};

const server = http.createServer((req, res) => {
    // Handle WordPress theme download
    if (req.url === '/download-theme' || req.url === '/download-theme/') {
        const filePath = path.join(__dirname, 'myqrcodetool-wordpress-theme.zip');
        
        if (fs.existsSync(filePath)) {
            const stat = fs.statSync(filePath);
            res.writeHead(200, {
                'Content-Type': 'application/zip',
                'Content-Length': stat.size,
                'Content-Disposition': 'attachment; filename=myqrcodetool-wordpress-theme.zip'
            });
            fs.createReadStream(filePath).pipe(res);
        } else {
            res.writeHead(404, { 'Content-Type': 'text/plain' });
            res.end('Theme ZIP file not found');
        }
        return;
    }

    // Serve static files from extracted_site
    let urlPath = req.url.split('?')[0]; // Remove query strings
    
    // Default to index.html for directories
    if (urlPath.endsWith('/')) {
        urlPath += 'index.html';
    }
    
    // If no extension and path doesn't end with /, try as directory
    if (!path.extname(urlPath) && !urlPath.endsWith('/')) {
        urlPath += '/index.html';
    }

    const filePath = path.join(STATIC_DIR, urlPath);

    // Security: prevent directory traversal
    if (!filePath.startsWith(STATIC_DIR)) {
        res.writeHead(403, { 'Content-Type': 'text/plain' });
        res.end('Forbidden');
        return;
    }

    fs.readFile(filePath, (err, data) => {
        if (err) {
            // Try serving 404 page
            const notFoundPath = path.join(STATIC_DIR, '404', 'index.html');
            fs.readFile(notFoundPath, (err404, data404) => {
                if (err404) {
                    res.writeHead(404, { 'Content-Type': 'text/plain' });
                    res.end('File not found');
                } else {
                    res.writeHead(404, { 
                        'Content-Type': 'text/html; charset=utf-8',
                        'Cache-Control': 'no-cache'
                    });
                    res.end(data404);
                }
            });
            return;
        }

        const ext = path.extname(filePath).toLowerCase();
        const contentType = mimeTypes[ext] || 'application/octet-stream';
        
        res.writeHead(200, { 
            'Content-Type': contentType + (ext === '.html' ? '; charset=utf-8' : ''),
            'Cache-Control': 'no-cache'
        });
        res.end(data);
    });
});

server.listen(PORT, '0.0.0.0', () => {
    console.log(`QR Code Generator Website Preview running at http://0.0.0.0:${PORT}`);
    console.log('Preview your static site at the root URL');
    console.log('Download WordPress theme at /download-theme');
});
