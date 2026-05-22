import { Router } from 'express';
import { httpGetAllLaunches } from '../controllers/launches.controller.js';

const router = Router();

router.get('/', httpGetAllLaunches);

export default router;