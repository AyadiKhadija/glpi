module.exports = {
    setupFilesAfterEnv: ["jest-extended"],
    setupFiles: ['<rootDir>/tests/js/bootstrap.js'],
    transform: {
        '^.+\\.js$': 'babel-jest',
    },
    testEnvironment: 'jsdom',
    slowTestThreshold: 10,
};