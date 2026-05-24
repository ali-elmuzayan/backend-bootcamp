import { Router } from 'express';
import planetsRouter from './planets.router.js';
import launchesRouter from './launches.router.js';

const router = Router();

router.use('/planets', planetsRouter);
router.use('/launches', launchesRouter);

export default router;