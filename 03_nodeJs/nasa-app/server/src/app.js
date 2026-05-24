import express from 'express';
import path from 'path';
import apiRouter from './routes/api.js';
import cors from 'cors';
import morgan from 'morgan';

export const createApp = () => {
    const app = express();
    const __dirname = path.resolve();
    // Middlewares
    app.use(cors({
        origin: 'http://localhost:3000',
    }));
    app.use(morgan('short'));
    app.use(express.json());
    app.use(express.static(path.join(__dirname, './public'))); // Serve static files from the public directory


    // define API routes 
    app.use('/api/v1', apiRouter);

    // Serve the React app for the root route
    app.use((req, res) => {
        res.sendFile(path.join(__dirname, './public', 'index.html'));
    }); 

    return app;
}
