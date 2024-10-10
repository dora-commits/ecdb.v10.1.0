(() => {
  'use strict'

  const getStoredTheme = () => localStorage.getItem('theme')
  const setStoredTheme = theme => localStorage.setItem('theme', theme)

  const getPreferredTheme = () => {
    const storedTheme = getStoredTheme()
    if (storedTheme) {
      return storedTheme
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
  }

  const setTheme = theme => {
    document.documentElement.setAttribute('data-bs-theme', theme)
  }

  setTheme(getPreferredTheme())

  const showActiveTheme = (theme) => {
    const activeThemeIcon = document.querySelector('.theme-icon-active use')
    const themeSwitcher = document.querySelector('#bd-theme-text')

    const svgIcon = theme === 'light' ? '#sun-fill' : '#moon-stars-fill'
    activeThemeIcon.setAttribute('href', svgIcon)
    themeSwitcher.textContent = `Current theme: ${theme}`
  }

  const toggleTheme = () => {
    // console.log('button clicked!!!')
    const currentTheme = getStoredTheme() || getPreferredTheme()
    const newTheme = currentTheme === 'light' ? 'dark' : 'light'

    setStoredTheme(newTheme)
    setTheme(newTheme)
    showActiveTheme(newTheme)
  }

  window.addEventListener('DOMContentLoaded', () => {
    showActiveTheme(getPreferredTheme())

    const themeButton = document.querySelector('#bd-theme')
    themeButton.addEventListener('click', toggleTheme)
  })
})()
