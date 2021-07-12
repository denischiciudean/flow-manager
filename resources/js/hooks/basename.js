const basename = (path) => typeof path == 'string' ? path.substring(path.lastIndexOf('/') + 1) : '-';
export default basename;
