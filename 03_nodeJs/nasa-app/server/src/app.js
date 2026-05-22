import express from 'express';
import planetsRouter from './routes/planets.router';

export const createApp = () => {
    const app = express();

    // Middlewares
    app.use(express.json());


    // define routes 
    app.use('/api/v1/planets', planetsRouter);



    return app;
}
