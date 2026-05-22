import launches from '../models/launchs.model.js';

const httpGetAllLaunches = (req, res) => {
    return res.status(200).json({
        message: 'Launches fetched successfully',
        data: Array.from(launches.values())
    });
}

export {
    httpGetAllLaunches,
};