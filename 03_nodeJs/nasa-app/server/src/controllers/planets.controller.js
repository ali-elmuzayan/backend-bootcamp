import { getAllPlanets } from '../models/planets.model.js';

/**
 * get all planets
 */
const httpGetAllPlanets = (req, res) => {
    if (getAllPlanets().length === 0) {
        res.status(404).json({
            message: 'No planets found',
            data: []
        });
        return;
    }
    res.status(200).json({
        message: 'Planets fetched successfully',
        data: getAllPlanets()
    })
}

/**
 * get a planet by id
 */
const httpGetPlanetById = (req, res) => {
    const { id } = req.params;
    const planet = getAllPlanets().find((planet) => planet.id === Number(id)); 
    if (!planet) {
        return res.status(404).json({
            message: 'Planet not found',
            data: null
        })
    }
    res.status(200).json({
        message: 'Planet fetched successfully',
        data: planet
    })
}


export {
    httpGetAllPlanets,
    httpGetPlanetById,
};