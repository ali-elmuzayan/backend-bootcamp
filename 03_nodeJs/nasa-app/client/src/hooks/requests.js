const API_URL = 'http://localhost:5000/api/v1';

async function httpGetPlanets() {
  const response = await fetch(`${API_URL}/planets`);
  const data = await response.json();
  console.log("get planets data", data);
  return data.data;
}

async function httpGetLaunches() {
  const response = await fetch(`${API_URL}/launches`);
  const data = await response.json();
  console.log("get launches data", data);
  return data.data.sort((a, b) => a.flightNumber - b.flightNumber);
  // TODO: Once API is ready.
  // Load launches, sort by flight number, and return as JSON.
}

async function httpSubmitLaunch(launch) {
  // TODO: Once API is ready.
  // Submit given launch data to launch system.
}

async function httpAbortLaunch(id) {
  // TODO: Once API is ready.
  // Delete launch with given ID.
}

export {
  httpGetPlanets,
  httpGetLaunches,
  httpSubmitLaunch,
  httpAbortLaunch,
};