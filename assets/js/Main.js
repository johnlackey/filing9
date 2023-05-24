import React, { StrictMode } from 'react'

import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import ItemList from '../pages/ItemList'
import ItemCreate from '../pages/ItemCreate'
import ItemEdit from '../pages/ItemEdit'
import ItemShow from '../pages/ItemShow'

function Main () {
  return (
    <Router>
      <Routes>
        <Route exact path='/' element={<ItemList />} />
        <Route path='/create' element={<ItemCreate />} />
        <Route path='/edit/:id' element={<ItemEdit />} />
        <Route path='/show/:id' element={<ItemShow />} />
      </Routes>
    </Router>
  )
}

export default Main

if (document.getElementById('app')) {
  const rootElement = document.getElementById('app')
  const root = createRoot(rootElement)

  root.render(
    <StrictMode>
      <Main />
    </StrictMode>
  )
}
