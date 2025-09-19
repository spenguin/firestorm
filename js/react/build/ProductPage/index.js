// Product Page component
// created 16-12-2024

// import nodes
import React from "react";
import ReactDOM from "react-dom";

// import components
import ProductPage from "./Components/ProductPage.jsx"; 

ReactDOM.render(
    <ProductPage
        collection_children = {collection_children}
        products_children   = {products_children}
        products            = {products}
    />,
    document.getElementById('ProductPage')
);