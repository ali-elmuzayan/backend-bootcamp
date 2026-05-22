import { Router } from 'express';
import { getAllPlanets, getPlanetById, createPlanet, updatePlanet, deletePlanet } from '../controllers/planets.controller.js';
const router = Router();

router.get('/', getAllPlanets);

router.get('/:id', getPlanetById);

router.post('/', createPlanet);

router.put('/:id', updatePlanet);

router.delete('/:id', deletePlanet);

export default router;