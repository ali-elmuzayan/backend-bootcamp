const launches = new Map();

let latestFlightNumber = 100;

const firstLaunch = {
    flightNumber: 100,
    mission: 'Kepler Exploration X',
    rocket: 'Explorer IS1',
    launchDate: new Date('2030-12-27'),
    target: 'Kepler-442 b',
    customers: ['ZTM', 'NASA'],
    upcoming: true,
    success: true,
}

const secondLaunch = {
    flightNumber: 101,
    mission: 'Kepler Exploration Y',
    rocket: 'Explorer IS1',
    launchDate: new Date('2030-12-28'),
    target: 'Kepler-442 c',
    customers: ['ZTM', 'NASA'],
    upcoming: true,
    success: true,
}   

launches.set(firstLaunch.flightNumber, firstLaunch);
launches.set(secondLaunch.flightNumber, secondLaunch);

const getAllLaunches = () => {
    return Array.from(launches.values());
};

const addNewLaunch = (launch) => {
    latestFlightNumber++;
    launches.set(latestFlightNumber, Object.assign(launch, {
        flightNumber: latestFlightNumber,
        upcoming: true,
        success: true,
    }));
};

export { getAllLaunches, addNewLaunch };