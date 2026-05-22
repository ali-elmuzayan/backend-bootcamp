import express from 'express';
import planetsRouter from './routes/planets.router.js';
import cors from 'cors';

export const createApp = () => {
    const app = express();

    // Middlewares
    app.use(cors({
        origin: 'http://localhost:3000',
    }));
    app.use(express.json());


    // define routes 
    app.use('/api/v1/planets', planetsRouter);



    return app;
}
