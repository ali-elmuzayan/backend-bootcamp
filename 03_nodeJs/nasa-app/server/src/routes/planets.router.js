import { Router } from 'express';

const router = Router();

router.get('/', getAllPlanets);

router.get('/:id', getPlanetById);

router.post('/', createPlanet);

router.put('/:id', updatePlanet);

router.delete('/:id', deletePlanet);

export default router;