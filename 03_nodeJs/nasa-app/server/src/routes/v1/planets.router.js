import { Router } from 'express';
import { httpGetAllPlanets, httpGetPlanetById } from '../../controllers/planets.controller';
const router = Router();

router.get('/', httpGetAllPlanets);

router.get('/:id', httpGetPlanetById);

export default router;