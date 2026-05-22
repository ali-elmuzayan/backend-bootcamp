import { getAllLaunches, addNewLaunch } from '../models/launchs.model.js';

/**
 * get all launches
 */
const httpGetAllLaunches = (req, res) => {
    return res.status(200).json({
        message: 'Launches fetched successfully',
        data: getAllLaunches()
    });
}

/**
 * add a new launch
 */
const httpAddNewLaunch = (req, res) => {
    const launch = req.body;
    launch.launchDate = new Date(launch.launchDate);


    if (!launch.mission || !launch.rocket || !launch.launchDate || !launch.target) {
        return res.status(400).json({
            message: 'Invalid launch data',
            data: null
        });
    }


    const newFlightNumber = addNewLaunch(launch);
    return res.status(201).json({
        message: 'Launch added successfully',
        data: newFlightNumber
    });
}

export {
    httpGetAllLaunches,
    httpAddNewLaunch,
};