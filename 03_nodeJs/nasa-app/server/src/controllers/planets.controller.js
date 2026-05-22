import planets from '../models/planets.model.js';

/**
 * get all planets
 */
const getAllPlanets = (req, res) => {
    if (mockPlanets.length === 0) {
        res.status(404).json({
            message: 'No planets found',
            data: []
        });
        return;
    }
    res.status(200).json({
        message: 'Planets fetched successfully',
        data: mockPlanets
    })
}

/**
 * get a planet by id
 */
const getPlanetById = (req, res) => {
    const { id } = req.params;
    const planet = mockPlanets.find((planet) => planet.id === Number(id)); 
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

/**
 * create a planet
 */
const createPlanet = (req, res) => {
    const { name, description } = req.body;
    const newPlanet = {
        id: mockPlanets.length + 1,
        name,
        description
    }
    mockPlanets.push(newPlanet);
    res.status(201).json({
        message: 'Planet created successfully',
        data: newPlanet
    })
}


/**
 * Update a Planet
 */
const updatePlanet = (req, res) => {
    const { id } = req.params;
    const { name, description } = req.body;
    const planet = mockPlanets.find((planet) => planet.id === Number(id));
    if (!planet) {
        return res.status(404).json({
            message: 'Planet not found',
            data: null
        })
    }
    planet.name = name;
    planet.description = description;
    res.status(200).json({
        message: 'Planet updated successfully',
        data: planet
    })
}

/**
 * Delete a Planet
 */
const deletePlanet = (req, res) => {
    const { id } = req.params;
    const planet = mockPlanets.find((planet) => planet.id === Number(id));
    if (!planet) {
        return res.status(404).json({
            message: 'Planet not found',
            data: null
        })
    }
    mockPlanets = mockPlanets.filter((planet) => planet.id !== Number(id));
    res.status(200).json({
        message: 'Planet deleted successfully',
        data: null
    })
}




export {
    getAllPlanets, 
    getPlanetById,
    createPlanet, 
    updatePlanet, 
    deletePlanet, 
}