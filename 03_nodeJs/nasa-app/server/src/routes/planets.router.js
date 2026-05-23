import { Router } from 'express';
import { httpGetAllPlanets, httpGetPlanetById } from '../controllers/planets.controller.js';
const router = Router();

router.get('/', httpGetAllPlanets);

router.get('/:id', httpGetPlanetById);

export default router;