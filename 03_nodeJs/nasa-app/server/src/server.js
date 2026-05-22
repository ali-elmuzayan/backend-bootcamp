import { createApp } from './app.js';
import http from 'http';


const startServer = async () => {
    const PORT = process.env.PORT || 5000;
    try {
        const app = createApp();
        const server = http.createServer(app);
        server.listen(PORT, () => {
            console.log(`Server is running on port ${PORT}`);
        });
    } catch (error) {
        console.error(error);
        process.exit(1);
    }
}

startServer();