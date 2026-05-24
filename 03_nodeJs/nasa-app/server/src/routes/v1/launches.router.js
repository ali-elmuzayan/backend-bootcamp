import { Router } from 'express';
import { httpGetAllLaunches, httpAddNewLaunch } from '../../controllers/launches.controller';

const router = Router();

router.get('/', httpGetAllLaunches);
router.post('/', httpAddNewLaunch);


export default router;